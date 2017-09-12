<?php


namespace Profit\Nordea\API\Parser;


use Profit\Nordea\API\Parser\TITORecords\BalanceRecord;
use Profit\Nordea\API\Parser\TITORecords\BasicAccountNotificationRecord;
use Profit\Nordea\API\Parser\TITORecords\BasicAccountStatement;
use Profit\Nordea\API\Parser\TITORecords\BasicAccountTransactionRecord;
use Profit\Nordea\API\Parser\TITORecords\CumulativeBasicRecord;
use Profit\Nordea\API\Parser\TITORecords\CumulativeCorrectionRecord;
use Profit\Nordea\API\Parser\TITORecords\MessageRecord;
use Profit\Nordea\API\Parser\TITORecords\Record;
use Profit\Nordea\API\Parser\TITORecords\RecordInterface;
use Profit\Nordea\API\Parser\TITORecords\SpecialRecord;
use Profit\Nordea\API\Parser\TITORecords\SupplementaryNotificationRecord;
use Profit\Nordea\API\Parser\TITORecords\SupplementaryTransactionRecord;

class TITOParser
{
    static $types = [
        BalanceRecord::class,
        BasicAccountNotificationRecord::class,
        BasicAccountTransactionRecord::class,
        BasicAccountStatement::class,
        CumulativeBasicRecord::class,
        CumulativeCorrectionRecord::class,
        MessageRecord::class,
        SpecialRecord::class,
        SupplementaryNotificationRecord::class,
        SupplementaryTransactionRecord::class
    ];

    static public function getRecordMap()
    {
        $result = [];

        /** @var RecordInterface $type */
        foreach(self::$types as $type){
           $result[$type::getCode()] = $type;
        }

        return $result;
    }

    public function parseFileContent(string $content, $splitter = PHP_EOL)
    {
        return $this->parseLines(array_filter(explode($splitter, $content)));
    }

    /**
     * @param String[] $lines
     * @return array
     */
    public function parseLines(array $lines)
    {
        $types = self::getRecordMap();

        return array_map(function($line) use ($types){
            $code= substr($line, 1, 2);
            /** @var RecordInterface $type */
            $type = $types[$code];

            echo '**' . $code . ':' . $type . PHP_EOL;

            return $this->parseLine($type, $line);
        }, $lines);
    }

    public function parseLine($type, string $line)
    {
        $data = $type::getMap();

        $store = $line;

        array_walk_recursive($data, function(&$val, $key) use (&$store){
            $data = substr($store, 0, $val);

            $store = substr_replace($store, '', 0, $val);
            $val = $data;
        });

        /** @var Record $entity */
        $entity = new $type();

        $entity->setData($data);

        return $entity;
    }
}