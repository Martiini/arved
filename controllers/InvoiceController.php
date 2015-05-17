<?php

namespace app\controllers;

use app\models\Invoice;
use Yii;
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
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Invoice();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                return $this->redirect('edit?id=' . $model->id);
            }
        }

        return $this->render('create', [
            'model' => $model,
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
