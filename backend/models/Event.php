<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $Id
 * @property string $summary
 * @property string $description
 * @property string $area
 * @property string $start
 * @property string $end
 * @property string $duracao
 * @property int $provinciaID
 * @property int $municipioID
 * @property int $comunaID
 * @property string $local
 * @property string $coordenadas
 * @property string $entidadeOrganizadora
 * @property string $convocadoPor
 * @property string $participantes
 * @property UploadedFile $agenda
 * @property UploadedFile $listaParticipantes
 * @property UploadedFile $actaRelatorio
 * @property UploadeFile $outrosAnexos
 * 
 * @property Comuna $comuna
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summary', 'area', 'start', 'end', 'duracao', 'provinciaID', 'municipioID', 'comunaID', 'entidadeOrganizadora', 'convocadoPor', 'participantes'], 'required'],
            [['description', 'local'], 'string'],
            //[['participantes'], 'each', 'rule' => ['email']],
            [['start', 'end'], 'safe'],
            [['provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['summary', 'area', 'coordenadas', 'entidadeOrganizadora', 'convocadoPor'], 'string', 'max' => 50],
            [['duracao'], 'string', 'max' => 20],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
            [['agenda', 'listaParticipantes', 'actaRelatorio', 'outrosAnexos'], 'file', 'extensions' => 'pdf, doc, docx, xls, xlsx', 'maxSize' => 1024 * 1024 * 10], // Máximo de 10MB
//            [['outrosAnexos'], 'file', 'extensions' => 'pdf, doc, docx, xls, xlsx, jpg, jpeg, png, ppt, pptx, mp4, avi', 'maxSize' => 1024 * 1024 * 20], // Máximo de 20MB por arquivo, até 10 arquivos
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'summary' => Yii::t('app', 'Título'),
            'description' => Yii::t('app', 'Descrição'),
            'area' => Yii::t('app', 'Área (principal)'),
            'start' => Yii::t('app', 'Início'),
            'end' => Yii::t('app', 'Fim'),
            'duracao' => Yii::t('app', 'Duração'),
            'provinciaID' => Yii::t('app', 'Província'),
            'municipioID' => Yii::t('app', 'Município'),
            'comunaID' => Yii::t('app', 'Comuna'),
            'local' => Yii::t('app', 'Local'),
            'coordenadas' => Yii::t('app', 'Coordenadas'),
            'entidadeOrganizadora' => Yii::t('app', 'Entidade Organizadora'),
            'convocadoPor' => Yii::t('app', 'Convocado Por'),
            'participantes' => Yii::t('app', 'Participantes'),
            'agenda' => 'Agenda',
            'actaRelatorio' => 'Acta/Relatório',
            'listaParticipantes' => 'Lista de Participantes',
            'outrosAnexos' => 'Outros (imagem, video, documento etc)',
        ];
    }
//    public function beforeSave($insert)
//{
//    if (parent::beforeSave($insert)) {
//        if (is_array($this->outrosAnexos)) {
//            $this->outrosAnexos = implode(',', $this->outrosAnexos);
//        }
//        return true;
//    } else {
//        return false;
//    }
//}

//    public function afterFind()
//{
//    parent::afterFind();
//    if (!empty($this->outrosAnexos)) {
//        $this->outrosAnexos = explode(',', $this->outrosAnexos);
//    }
//}
     /**
     * Upload files method
     */
    public function uploadFiles()
    {
        if ($this->validate()) {
            if ($this->agenda) {
                $this->agenda->saveAs('uploads/' . $this->agenda->baseName . '.' . $this->agenda->extension);
                $this->agenda = 'uploads/' . $this->agenda->baseName . '.' . $this->agenda->extension;
            }
            if ($this->actaRelatorio) {
                $this->actaRelatorio->saveAs('uploads/' . $this->actaRelatorio->baseName . '.' . $this->actaRelatorio->extension);
                $this->actaRelatorio = 'uploads/' . $this->actaRelatorio->baseName . '.' . $this->actaRelatorio->extension;
            }
            if ($this->listaParticipantes) {
                $this->listaParticipantes->saveAs('uploads/' . $this->listaParticipantes->baseName . '.' . $this->listaParticipantes->extension);
                $this->listaParticipantes = 'uploads/' . $this->listaParticipantes->baseName . '.' . $this->listaParticipantes->extension;
            }
//            if ($this->outrosAnexos) {
//                $this->outrosAnexos->saveAs('uploads/' . $this->outrosAnexos->baseName . '.' . $this->outrosAnexos->extension);
//                $this->outrosAnexos = 'uploads/' . $this->outrosAnexos->baseName . '.' . $this->outrosAnexos->extension;
//            }
//           if (is_array($this->outrosAnexos)) {
//                $paths = [];
//                foreach ($this->outrosAnexos as $file) {
//                    $path = 'uploads/' . $file->baseName . '.' . $file->extension;
//                    $file->saveAs($path);
//                    $paths[] = $path;
//                }
//                // Serializar os caminhos como uma string delimitada por vírgulas
//                $this->outrosAnexos = implode(',', $paths);
//            
//                
//                }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets query for [[Comuna]].
     *
     * @return \yii\db\ActiveQuery
     */
  
    public function getComuna()
    {
        return $this->hasOne(Comuna::class, ['Id' => 'comunaID']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::class, ['Id' => 'municipioID']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }
    
   public static function getFilteredEvents($entidadesSelecionadas, $provinciasSelecionadas, $areasSelecionadas, $dataInicio = null, $dataFim = null)
{
//       $dataInicio=15634;
//      var_dump('entidade selected!' . $entidadesSelecionadas[0]);
    $query = Event::find();

    $filtersApplied = false; // Flag para controlar se algum filtro foi aplicado

    // Aplica filtro por entidades selecionadas
    if (!empty($entidadesSelecionadas)) {
        $query->andWhere(['in', 'entidadeOrganizadora', $entidadesSelecionadas]);
        $filtersApplied = true;
    }

    // Aplica filtro por províncias selecionadas
    if (!empty($provinciasSelecionadas)) {
        $query->joinWith('provincia')->andWhere(['in', 'provincia.nomeProvincia', $provinciasSelecionadas]);
        $filtersApplied = true;
    }

    // Aplica filtro por áreas selecionadas
    if (!empty($areasSelecionadas)) {
        $query->orWhere(['in', 'area', $areasSelecionadas]);
        $filtersApplied = true;
    }

    // Aplica filtro por intervalo de datas
    if (!($dataInicio == null && $dataFim == null && empty($dataInicio) && empty($dataFim))) {
        $query->andWhere(['between', 'start', $dataInicio, $dataFim]);
        $filtersApplied = true;
    }

    // Se nenhum filtro foi aplicado, retorna todos os eventos
    if (!$filtersApplied) {
        return Event::find()->all();
    }

    return $query->all();
}


}
