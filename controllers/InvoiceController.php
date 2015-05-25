<?php

namespace app\controllers;

use app\models\Client;
use app\models\Invoice;
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

    public function actionIndex()
    {
        $query = Invoice::find();

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
                'client' => $invoice->getClient()->one(),
            ]
        );
    }


}
