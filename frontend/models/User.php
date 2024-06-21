<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string $entidade
 * @property string $nomeCompleto
 *
 * @property Grupo[] $grupos
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'entidade'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['entidade','nomeCompleto'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Estado'),
            'created_at' => Yii::t('app', 'Data de Criação'),
            'updated_at' => Yii::t('app', 'Data de Actualização At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'entidade' => Yii::t('app', 'Entidade'),
            '$nomeCompleto' => Yii::t('app', 'Nome Completo'),
        ];
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::class, ['userID' => 'id']);
    }
    // metodo para definir qual botao aparecer para o usuario, validar, aprovar ou publicar
    public function getAcoesBotoes() {
        $user = Yii::$app->user;
        $acoes = [];

        if ($user->can('Permissao Validador de dados')) {
            $acoes[] = ['label' => '', 'url' => ['validar', 'id' => $this->id], 'class' => 'btn btn-success fas fa-check-square '];
        }
         if ($user->can('Permissao Validador de dados')) {
            $acoes[] = ['label' => '', 'url' => ['inativar', 'id' => $this->id], 'class' => 'btn btn-danger fas fa-thumbs-up'];
        }

       

        return $acoes;
    }
}
