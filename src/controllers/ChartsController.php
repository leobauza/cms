<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\app\controllers;

use Craft;
use craft\app\web\Controller;
use craft\app\helpers\DateTimeHelper;
use craft\app\helpers\ChartHelper;
use craft\app\db\Query;

/**
 * The ChartsController class is a controller that handles charts related operations such as preparing and returning data,
 * in a format ready to being displayed by Craft charts.
 *
 * Note that all actions in the controller require an authenticated Craft session via [[Controller::allowAnonymous]].
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class ChartsController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the data needed to display a New Users chart.
     *
     * @return void
     */
    public function actionGetNewUsersData()
    {
        $userGroupId = Craft::$app->getRequest()->getRequiredBodyParam('userGroupId');
        $startDateParam = Craft::$app->getRequest()->getRequiredBodyParam('startDate');
        $endDateParam = Craft::$app->getRequest()->getRequiredBodyParam('endDate');
        $schema = Craft::$app->getDb()->getSchema();

        $startDate = DateTimeHelper::toDateTime($startDateParam);
        $endDate = DateTimeHelper::toDateTime($endDateParam);
        $endDate->modify('+1 day');

        $intervalUnit = 'day';

        // Prep the query
        $query = (new Query())
            ->select('COUNT(*) as value')
            ->from('{{%users}} users');

        if ($userGroupId)
        {
            $query->innerJoin('{{%usergroups_users}} usergroups_users', $schema->quoteTableName('usergroups_users').'.'.$schema->quoteColumnName('userId').' = '.$schema->quoteTableName('users').'.'.$schema->quoteColumnName('id'));
            $query->where($schema->quoteTableName('usergroups_users').'.'.$schema->quoteColumnName('groupId').' = :userGroupId', array(':userGroupId' => $userGroupId));
        }

        // Get the chart data table
        $dataTable = ChartHelper::getRunChartDataFromQuery($query, $startDate, $endDate, $schema->quoteTableName('users').'.'.$schema->quoteColumnName('dateCreated'), array(
            'intervalUnit' => $intervalUnit,
            'valueLabel' => Craft::t('app', 'New Users'),
        ));

        // Get the total number of new users
        $total = 0;

        foreach($dataTable['rows'] as $row)
        {
            $total = $total + $row[1];
        }

        // Return everything
        return $this->asJson(array(
            'dataTable' => $dataTable,
            'total' => $total,

            'formats' => ChartHelper::getFormats(),
            'orientation' => Craft::$app->getLocale()->getOrientation(),
            'scale' => $intervalUnit,
        ));
    }
}
