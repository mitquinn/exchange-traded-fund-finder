<?php


namespace App\Services\ExchangeTradedFundRetrieval\Providers;


use App\Models\ExchangeTradedFund;
use App\Models\GeographicalBreakdown;
use App\Models\Holding;
use App\Models\Sector;
use App\Services\ExchangeTradedFundRetrieval\Interfaces\ExchangeTradedFundRetrievalInterface;
use App\Services\ExchangeTradedFundRetrieval\SimpleFund;
use App\Services\ExchangeTradedFundRetrieval\SimpleFundCollection;
use Cache;
use Exception;
use GuzzleHttp\Client;
use Log;
use PHPHtmlParser\Dom;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Ssga
 * @package App\Services\ExchangeTradedFundRetrieval\Providers
 */
class Ssga implements ExchangeTradedFundRetrievalInterface
{
    /** @var string $ssgaBaseUrl */
    protected string $ssgaBaseUrl = 'https://www.ssga.com';

    /**
     * @return SimpleFundCollection
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function fundList(): SimpleFundCollection
    {
        $simpleFundCollection = new SimpleFundCollection();
        $content = $this->retrieveFundList();
        $fundList = $content['data']['us']['funds']['etfs']['overview']['datas'];
        foreach ($fundList as $fund) {
            $fundUrl = $this->ssgaBaseUrl . $fund['fundUri'];
            $simpleFund = new SimpleFund($fund['fundTicker'], $fund['fundName'], $fundUrl);
            $simpleFundCollection->addSimpleFund($simpleFund);
        }

        return $simpleFundCollection;
    }


    public function fundDetails(SimpleFund $simpleFund): ExchangeTradedFund
    {
        $html = $this->retrieveDetailPage($simpleFund);
        $fundTopHoldings = $this->extractFundTopHoldings($html);
        $indexTopHoldings = $this->extractIndexTopHoldings($html);
        $fundSectorBreakdown = $this->extractFundSectorBreakdown($html);
        $indexSectorBreakdown = $this->extractIndexSectorBreakdown($html);
        $geographicalBreakdown = $this->extractGeographicalBreakdown($html);

        $exchangeTradedFund = ExchangeTradedFund::create([
            'name' => $simpleFund->getName(),
            'ticker' => $simpleFund->getIdentifier(),
        ]);

        if (count($fundTopHoldings) != 0) {
            $fundHolding = new Holding();
            $fundHolding->setData($fundTopHoldings)->setType('Fund Top Holdings')->save();
            $fundHolding->exchangeTradedFund()->associate($exchangeTradedFund)->save();
        }

        if (count($indexTopHoldings) != 0) {
            $indexHolding = new Holding();
            $indexHolding->setData($indexTopHoldings)->setType('Index Top Holdings')->save();
            $indexHolding->exchangeTradedFund()->associate($exchangeTradedFund)->save();
        }

        if (count($fundSectorBreakdown) != 0) {
            $fundSector = new Sector();
            $fundSector->setData($fundSectorBreakdown)->setType('Fund Sector Breakdown')->save();
            $fundSector->exchangeTradedFund()->associate($exchangeTradedFund)->save();
        }

        if (count($indexSectorBreakdown) != 0) {
            $indexSector = new Sector();
            $indexSector->setData($indexSectorBreakdown)->setType('Index Sector Breakdown')->save();
            $indexSector->exchangeTradedFund()->associate($exchangeTradedFund)->save();
        }

        if (count($geographicalBreakdown) != 0) {
            $geographical = new GeographicalBreakdown();
            $geographical->setData($geographicalBreakdown)->save();
            $geographical->exchangeTradedFund()->associate($exchangeTradedFund)->save();
        }

        return $exchangeTradedFund;
    }

    /**
     * @param $html
     * @return array
     */
    private function extractGeographicalBreakdown(&$html)
    {
        $crawler = new Crawler($html);
        $input = $crawler->filter('#fund-geographical-breakdown');
        if (count($input) == 0) {
            return [];
        }

        $value = $input->extract(['value'])[0];
        $data = json_decode($value, true);
        $attArray = $data['attrArray'];
        $return = [];
        foreach ($attArray as $items) {
            $individual = [];
            foreach ($items as $item) {
                $individual[$item['label']] = $item['value'];
            }
            $return[] = $individual;
        }
        return $return;
    }

    /**
     * @param $html
     * @return array
     */
    private function extractIndexSectorBreakdown(&$html)
    {
        $crawler = new Crawler($html);
        $tbody = $crawler->filter('.index-sector-breakdown > .main-content > table');
        if (count($tbody) == 0) {
            return [];
        }
        $ths = $tbody->filter('th')->extract(['_text']);
        $tds = $tbody->filter('td')->extract(['_text']);
        $chunks = array_chunk($tds, count($ths));
        $return = [];
        foreach ($chunks as $chunk) {
            $return[] = array_combine($ths, $chunk);
        }
        return $return;
    }

    private function extractFundSectorBreakdown(&$html)
    {
        $crawler = new Crawler($html);
        $tbody = $crawler->filter('.fund-sector-breakdown > .main-content > table');
        if (count($tbody) == 0) {
            return [];
        }
        $ths = $tbody->filter('th')->extract(['_text']);
        $tds = $tbody->filter('td')->extract(['_text']);
        $chunks = array_chunk($tds, count($ths));
        $return = [];
        foreach ($chunks as $chunk) {
            $return[] = array_combine($ths, $chunk);
        }
        return $return;
    }

    /**
     * @param $html
     * @return array
     */
    private function extractIndexTopHoldings(&$html)
    {
        $crawler = new Crawler($html);
        $tbody = $crawler->filter('.index-top-holdings > table');
        if (count($tbody) == 0) {
            return [];
        }
        $ths = $tbody->filter('th')->extract(['_text']);
        $tds = $tbody->filter('td')->extract(['_text']);
        $chunks = array_chunk($tds, count($ths));
        $return = [];
        foreach ($chunks as $chunk) {
            $return[] = array_combine($ths, $chunk);
        }
        return $return;
    }


    /**
     * @param $html
     * @return array
     */
    private function extractFundTopHoldings(&$html)
    {
        $crawler = new Crawler($html);
        $tbody = $crawler->filter('.fund-top-holdings > table');
        if(count($tbody) == 0) {
            return [];
        }
        $ths = $tbody->filter('th')->extract(['_text']);
        $tds = $tbody->filter('td')->extract(['_text']);
        $chunks = array_chunk($tds, count($ths));
        $return = [];
        foreach ($chunks as $chunk) {
            $return[] = array_combine($ths, $chunk);
        }
        return $return;
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     * @throws Exception
     */
    private function retrieveFundList(): array
    {
        if (Cache::has('SsgaFundList')) {
            return Cache::get('SsgaFundList');
        }

        $client = new Client();
        try {
            $response = $client->get($this->getSsgaBaseUrl().'/bin/v1/ssmp/fund/fundfinder?country=us&language=en&role=individual&product=etfs&ui=fund-finder');
            if ($response->getStatusCode() != 200) {
                throw new Exception($response->getReasonPhrase(), $response->getStatusCode());
            }

            $body = $response->getBody()->getContents();
            $content = json_decode($body, true);
            Cache::set('SsgaFundList', $content, now()->addDay());
            return $content;
        } catch (Exception $exception) {
            $message = 'Ssga - retrieveFundList - '. $exception->getMessage();
            Log::error($message);
            throw new Exception($message, 500, $exception);
        }
    }

    /**
     * @param SimpleFund $simpleFund
     * @return string
     * @throws InvalidArgumentException
     */
    private function retrieveDetailPage(SimpleFund $simpleFund): string
    {
        if (Cache::has($simpleFund->getIdentifier().'DetailPage')) {
            return Cache::get($simpleFund->getIdentifier().'DetailPage');
        }

        $client = new Client();
        try {
            $response = $client->get($simpleFund->getDetailUrl());
            if ($response->getStatusCode() != 200) {
                throw new Exception($response->getReasonPhrase(), $response->getStatusCode());
            }
            $body = $response->getBody()->getContents();
            Cache::set($simpleFund->getIdentifier().'DetailPage', $body, now()->addDay());
            return $body;
        } catch (Exception $exception) {
            $message = 'Ssga - retrieveDetailPage - '. $exception->getMessage();
            Log::error($message);
            throw new Exception($message, 500, $exception);
        }
    }


    /**
     * @return string
     */
    public function getSsgaBaseUrl(): string
    {
        return $this->ssgaBaseUrl;
    }

    /**
     * @param string $ssgaBaseUrl
     * @return Ssga
     */
    public function setSsgaBaseUrl(string $ssgaBaseUrl): Ssga
    {
        $this->ssgaBaseUrl = $ssgaBaseUrl;
        return $this;
    }

}
