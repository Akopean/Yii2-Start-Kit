<?php

namespace backend\controllers;



use backend\models\search\MenusSearch;
use common\models\AdjacencyList;
use common\models\MenuItem;
use common\models\Menus;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class MenuController extends Controller
{

    /**
     * Lists all Options models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            //      'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * @param $id
     * @return string
     */
    public function actionBuild($id)
    {
        $model = $this->findModel($id);
        $menuItem = MenuItem::find()->roots()->orderBy(['order' => 'ASC','parent_id' => 'ASC'])->all();
        return $this->render('build', [
            'model' => $model,
            'menuItem' => $menuItem
        ]);
    }

    /**
     * @param $id
     */
    public function actionOrder($id)
    {
        if (Yii::$app->request->isPost){
            $menuItemOrder = json_decode(Yii::$app->request->post('order'));
            $this->orderMenu($menuItemOrder, null);
        }
    }

    /**
     * @param array $menuItems
     * @param $parentId
     */
    private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $menuItem) {
            $item = MenuItem::find()->where(['id' => $menuItem->id])->one();
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();
            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionCreateItem($id)
    {
        $menu = $this->findModel($id);
        $model = new MenuItem();
        $data = [
            'message'    => \Yii::t('backend', 'This name is exist'),
            'alert-type' => 'danger',
        ];
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $menu) {

            $model->menu_id = $menu->id;
            $model->save();
            $data = [
                'message'    => \Yii::t('backend', "Success"),
                'alert-type' => 'success',
            ];
        }
        \Yii::$app->session->addFlash($data['alert-type'], $data['message']);
        return $this->redirect(Yii::$app->request->referrer);
    }


    /**
     * @param $id
     * @param $number
     * @return \yii\web\Response
     */
    public function actionDeleteItem($id, $number)
    {
        $model = MenuItem::find()->where(['menu_id' => $id, 'id' => $number])->one();
        $data = [
            'message'    => \Yii::t('backend', 'This item not find!'),
            'alert-type' => 'danger',
        ];
        if (Yii::$app->request->isPost && $model && $model->delete()) {
            $data = [
                'message'    => \Yii::t('backend', "Success"),
                'alert-type' => 'success',
            ];
        }
        \Yii::$app->session->addFlash($data['alert-type'], $data['message']);
        return $this->redirect(Yii::$app->request->referrer);
    }


    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}