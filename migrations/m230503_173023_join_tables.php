<?php

use yii\db\Migration;

/**
 * Class m230503_173023_join_tables
 */
class m230503_173023_join_tables extends Migration
{
    const T_HISTORY = 'history';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        self::clearHistoryData();

        foreach (['sms', 'fax', 'call', 'task'] as $tableName) {
            $history = self::getHistoryByObjectName($tableName);
            $updateSQL = self::generateUpdateSQL($tableName, $history);
            if ($updateSQL) {
                self::executeSQL($updateSQL);
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /**
     * @param array $history
     * @return array
     */
    public static function prepareHistory(array $history): array
    {
        $result = [];
        foreach ($history as $item) {
            $result[] = [$item['object_id'], $item['id']];
        }

        return $result;
    }

    /**
     * @return int
     * @throws \yii\db\Exception
     */
    public static function clearHistoryData(): int
    {
        return \Yii::$app->db->createCommand()
            ->delete(self::T_HISTORY, ['in', 'object', ['call_ytel', 'deal', 'lead']])
            ->execute();
    }

    /**
     * @param string $objectName
     * @return array
     */
    public static function getHistoryByObjectName(string $objectName): array
    {
        return \app\models\History::find()->select(['id', 'object_id', 'object'])->asArray()->all();
    }

    /**
     * @param string $tableName
     * @param array $history
     * @return string|null
     */
    public static function generateUpdateSQL(string $tableName, array $history): ?string
    {
        $sql = null;
        foreach ($history as $item) {
            $sql .= "UPDATE `{$tableName}` SET history_id = {$item['id']} WHERE id = {$item['object_id']};";
        }
        return $sql;
    }

    /**
     * @param string $sql
     * @return int
     * @throws \yii\db\Exception
     */
    public static function executeSQL(string $sql): int
    {
        return \Yii::$app->db->createCommand($sql)->execute();
    }
}
