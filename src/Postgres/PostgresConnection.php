<?php

namespace AtollAtom\Database\Postgres;

use DateTimeInterface;
use Illuminate\Database\PostgresConnection as BasePostgresConnection;
use PDO;

class PostgresConnection extends BasePostgresConnection
{
    public function bindValues($statement, $bindings)
    {
        if ($this->getPdo()->getAttribute(PDO::ATTR_EMULATE_PREPARES)) {
            foreach ($bindings as $key => $value) {
                $parameter = is_string($key) ? $key : $key + 1;

                if (is_bool($value)) {
                    $dataType = PDO::PARAM_BOOL;
                } elseif ($value === null) {
                    $dataType = PDO::PARAM_NULL;
                } else {
                    $dataType = PDO::PARAM_STR;
                }

                $statement->bindValue($parameter, $value, $dataType);
            }
        } else {
            parent::bindValues($statement, $bindings);
        }
    }

    public function prepareBindings(array $bindings)
    {
        if ($this->getPdo()->getAttribute(PDO::ATTR_EMULATE_PREPARES)) {
            $grammar = $this->getQueryGrammar();

            foreach ($bindings as $key => $value) {
                if ($value instanceof DateTimeInterface) {
                    $bindings[$key] = $value->format($grammar->getDateFormat());
                }
            }

            return $bindings;
        } else {
            return parent::prepareBindings($bindings);
        }
    }
}
