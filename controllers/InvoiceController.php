<?php

namespace app\controllers;

use app\models\Client;
use app\models\Invoice;
use app\models\InvoiceItem;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class InvoiceController extends Controller
{


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionApi() {
        $action = Yii::$app->request->post('action');

        switch($action) {
            case 'add':

                $model = new InvoiceItem();
                $model->invoice_id = Yii::$app->request->post('invoice_id');
                $model->name = Yii::$app->request->post('name');
                $model->sum = Yii::$app->request->post('sum');
                if($model->save()) {
                    die(var_export($model->id));
                }

                break;

            case 'remove':

                $item = InvoiceItem::find()->where(['id' => Yii::$app->request->post('item_id')])->one();

                if ($item) {
                    $item->delete();
                    die('success');
                }

                break;
        }
        die('failed');
    }

    public function actionJson() {
        $id = $id = Yii::$app->request->get('invoice_id');

        $invoice = Invoice::find()->where(['id' => $id])->one();

        $data['invoice'] = $invoice->toArray();
        $data['client'] = Client::find()->where(['id' => $invoice->client_id])->one()->toArray();
        $data['rows'] = InvoiceItem::find()->where(['invoice_id' => $invoice->id])->asArray()->all();
        die(json_encode($data));
    }

    public function actionIndex()
    {

        $id = Yii::$app->request->get('client_id');

        if ($id) {
            $query = Invoice::find()->where(['client_id' => $id]);
        } else {
            $post = Yii::$app->request->get();
            $name = isset($post['search']) ? explode(' ', $post['search']) : false;

            $client = $name ? Client::find()->where(['or like', 'first_name', $name])->orWhere(['or like', 'last_name', $name])->one() : false;
            $query = $client ? Invoice::find()->where(['client_id' => $client->id]) : Invoice::find();
        }

        $pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);

        $clients = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'invoices' => $clients,
            'pagination' => $pagination,
        ]);
    }

    public function actionCreate()
    {
        $model = new Invoice();
        $rawClients = Client::find()->all();

        $clients = [];

        foreach ($rawClients as $client) {
            $clients[$client->id] = $client->first_name . ' ' .$client->last_name;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                return $this->redirect('edit?id=' . $model->id);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'clients' => $clients,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $invoiceModel = new Invoice();

        $invoice = $invoiceModel->find($id)->one();

        return $this->render('edit',
            [
                'invoice' => $invoice,
                'invoice_items' => InvoiceItem::find()->where(['invoice_id' => $invoice->id])->all(),
                'sum' => (int) InvoiceItem::find()->where(['invoice_id' => $invoice->id])->sum('sum'),
                'client' => $invoice->getClient()->one(),
            ]
        );
    }

    public function actionRemove() {
        $id = Yii::$app->request->get('id');
        Invoice::find()->where(['id' => $id])->one()->delete();
        $this->redirect('index');
    }


}
