<?php

namespace vortexgin\yii2\crud\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CRUDController extends Controller
{

    /** @var \yii\db\ActiveRecord $model */
    public static $model;

    /** @var \yii\db\ActiveRecord $modelSearch */
    public static $modelSearch;

    /**
     * [Optional] This flag used for set user access permission
     */
    public static $permissions = null;

    /**
     * Lists all row models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new static::$modelSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('@yii2-crud/views/index', [
            'model' => new static::$model(),
            'indexField' => $this->indexFields(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single data model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('@yii2-crud/views/view', [
            'model' => $this->findModel($id),
            'viewField' => $this->viewFields(),
        ]);
    }

    /**
     * Creates a new data model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new static::$model(!empty(static::$permissions) ? ['permissions' => static::$permissions] : []);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('@yii2-crud/views/create', [
            'model' => $model,
            'formField' => $this->formFields(),
        ]);
    }

    /**
     * Updates an existing Organizer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('@yii2-crud/views/update', [
            'model' => $model,
            'formField' => $this->formFields(),
        ]);
    }

    /**
     * Deletes an existing Organizer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Organizer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organizer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = new static::$model();
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Index fields. See GridView column for reference
     *
     * @return array
     */
    public function indexFields()
    {
        return [];
    }

    /**
     * View fields. See DetailView attributes for reference
     *
     * @return array
     */
    public function viewFields()
    {
        return [];
    }

    /**
     * Form fields. Override this function to generate form fields
     *
     * @example
     * ```
     *  $formField = [
     *      [
     *          'field' => 'name',
     *          'type' => 'text|email|password|number|hidden|file|checkbox|radio|select|select2|textarea|richtext|maps|date|time|datetime // Default: text
     *          'label' => 'Name',
     *          'hint' => 'Only accept number format',
     *          'options' => [], // See HTML options,
     *          'items' => [] // For options at select, radio & checkbox
     *      ]
     *  ];
     * ```
     * @return array
     */
    public function formFields()
    {
        return [];
    }

}