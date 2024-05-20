<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        // 'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }
 public function actionSearchRresults() {
        return $this->render('search-results');
    }
    
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
//        //if (!Yii::$app->user->isGuest) {
//            //return $this->goHome();
//            return $this->redirect(Yii::$app->urlManagerBackend->createUrl(['site/index']));
//        }
        // Este login so é chamado apos o logout no backend e apos verificar desde a publica que não está logado
        Yii::$app->user->logout();
        Yii::$app->session->destroy(); // Isso encerrará a sessão      
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
           return $this->redirect(Yii::$app->urlManagerBackend->createUrl(['site/index']));
          }
        $model->password = '';

        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();
Yii::$app->session->destroy(); // Isso encerrará a sessão
        //return $this->goHome();

     return $this->redirect(Url::to(['site/login']));
     // return $this->redirect(Yii::$app->urlManager->createUrl(['site/login']));
    }

    /**
     * Displays contact_ page.
     *
     * @return mixed
     */
    public function actionContact_() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact_', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Displays politica page.
     *
     * @return mixed
     */
    public function actionPolitica() {
        return $this->render('politica');
    }

    /**
     * Displays resultado page.
     *
     * @return mixed
     */
    public function actionResultado() {
        return $this->render('resultado');
    }

    /**
     * Displays contacto page.
     *
     * @return mixed
     */
    public function actionContacto() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('sucesso', 'Obriado por contactar-nos. Responderemos o mais breve possível.');
            } else {
                Yii::$app->session->setFlash('erro', 'Houve algum erro ao enviar sua mensagem.');
            }

            return $this->refresh();
        }

        return $this->render('contacto', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays galeria page.
     *
     * @return mixed
     */
    public function actionGaleria() {
        return $this->render('galeria');
    }

    /**
     * Displays meta page.
     *
     * @return mixed
     */
    public function actionMeta() {
        return $this->render('meta');
    }

    public function actionMissao() {
        return $this->render('missao');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('sucesso', 'Obrigado por cadastrar-se. Por favor verifique sua caixa de entrada para verificar seu email.');
            // return $this->goHome();
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token) {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail() {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
                    'model' => $model
        ]);
    }

    public function actionTest($param) {
        $client = Elastic\Elasticsearch\ClientBuilder::create()->build();
        $client = ClientBuilder::create()
                ->setHosts(['<elasticsearch-endpoint>'])
                ->setApiKey('<api-key>')
                ->build();
    }
}
