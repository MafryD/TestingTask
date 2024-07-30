<?php

namespace app\controllers;

use app\models\ImageUpload;
use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['author_id'=>Yii::$app->user->id]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);
        $post=Post::find()->where(['author_id'=>Yii::$app->user->id]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'posts'=>$post,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();
        $modelAd= new ImageUpload();
        // $model->create_at = Yii::$app->formatter->asDatetime('now');
        if ($this->request->isPost) {
            //var_dump($model->image);
            if(UploadedFile::getInstance($modelAd,'img')!=null){
                $file=UploadedFile::getInstance($modelAd,'img');
                $filename=$modelAd->uploadFile($file);
                $model->image=$filename;
                if(Post::findOne(['image'=>$model->image])==null){
                    if ($model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } 
            }
            else{
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }   
            
            
            //var_dump($model->image);
            // var_dump($filename);die;
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelAd'=>$modelAd,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelAd= new ImageUpload();
        if($this->request->isPost) {
            if(UploadedFile::getInstance($modelAd,'img')!=null){
                $file=UploadedFile::getInstance($modelAd,'img');
                $filename=$modelAd->uploadFile($file);
                $model->image=$filename;
                if(Post::findOne(['image'=>$model->image])==null){
                    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                        return $this->redirect(['/post']);
                    }
                }
            }
            else{
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['/post']);
                }
            }   
        }

        return $this->render('update', [
            'model' => $model,
            'modelAd'=>$modelAd,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
