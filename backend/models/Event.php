<?php

namespace backend\models;

use Yii;
use yii\db\Query;

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
 * @property UploadedFile $listaConvidados
 * @property UploadedFile $pada
 * @property UploadedFile $actaRelatorio
 * @property UploadedFile $listaParticipantes
 * @property UploadeFile $outrosAnexos
 * 
 * @property Comuna $comuna
 * @property Municipio $municipio
 * @property Provincia $provincia
 */
class Event extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'event';
    }

//     public $outrosAnexos;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['summary', 'area', 'start', 'end', 'duracao', 'provinciaID', 'municipioID', 'comunaID', 'entidadeOrganizadora', 'convocadoPor', 'participantes'], 'required'],
            [['description', 'local'], 'string'],
            [['start', 'end'], 'safe'],
            [['provinciaID', 'municipioID', 'comunaID'], 'integer'],
            [['summary', 'area', 'coordenadas', 'entidadeOrganizadora', 'convocadoPor'], 'string', 'max' => 50],
            [['duracao'], 'string', 'max' => 20],
            [['comunaID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::class, 'targetAttribute' => ['comunaID' => 'Id']],
            [['municipioID'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipioID' => 'Id']],
            [['provinciaID'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::class, 'targetAttribute' => ['provinciaID' => 'Id']],
//            ['end', 'compare', 'compareAttribute' => 'start', 'operator' => '>=', 'type' => 'datetime', 'message' => 'A data de término deve ser posterior ou igual à data de início.'],
//            ['start', 'compare', 'compareAttribute' => 'end', 'operator' => '<=', 'type' => 'datetime', 'message' => 'A data de início deve ser inferior ou igual à data de término.'],
            [['agenda', 'listaConvidados', 'pada', 'listaParticipantes', 'actaRelatorio'], 'file', 'extensions' => 'pdf, doc, docx, xls, xlsx', 'maxSize' => 1024 * 1024 * 10],
            ['outrosAnexos', 'file', 'extensions' => 'mp4, jpg, png, ppt, pptx, pdf, doc, docx, xls, xlsx', 'maxSize' => 1024 * 1024 * 30, 'maxFiles' => 5], // Permite até 5 arquivos
        ];
    }

    public function attributeLabels() {
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
            'agenda' => Yii::t('app', 'Agenda'),
            'listaConvidados' => Yii::t('app', 'Lista de Convidados'),
            'pada' => Yii::t('app', 'PADA (UIC FRESAN/Camões, I.P.)'),
            'listaParticipantes' => Yii::t('app', 'Lista de Participantes'),
            'actaRelatorio' => Yii::t('app', 'Acta/Relatório'),
            'outrosAnexos' => Yii::t('app', 'Outros Anexos (ppt, video, imagem, documento ou planilha)'),
        ];
    }

    public function uploadFiles() {
        $uploadPath = Yii::getAlias('@webroot/uploads/') . '/';

        if (!(is_string($this->agenda)) && !empty($this->agenda) && $this->agenda!=null) {
            $this->agenda->saveAs('uploads/' . $this->agenda->baseName . '.' . $this->agenda->extension);
        }

        if (!empty($this->listaConvidados) &&!(is_string($this->listaConvidados)) && $this->listaConvidados!=null) {
            $this->listaConvidados->saveAs('uploads/' . $this->listaConvidados->baseName . '.' . $this->listaConvidados->extension);
            
        }

        if (!(is_string($this->pada))&& !empty($this->pada) && $this->pada!=null) {
            $this->pada->saveAs('uploads/' . $this->pada->baseName . '.' . $this->pada->extension);
        }
        if (!(is_string($this->actaRelatorio))&& !empty($this->actaRelatorio) && $this->actaRelatorio!=null) {
            $this->actaRelatorio->saveAs('uploads/' . $this->actaRelatorio->baseName . '.' . $this->actaRelatorio->extension);
        }

        if (!(is_string($this->listaParticipantes)) && !empty($this->listaParticipantes) && $this->listaParticipantes!=null) {
            $this->listaParticipantes->saveAs('uploads/' . $this->listaParticipantes->baseName . '.' . $this->listaParticipantes->extension);
        }

     if (!empty($this->outrosAnexos) && $this->outrosAnexos != "A confirmar" &&!(is_string($this->outrosAnexos)) && $this->outrosAnexos!=null) {
        $anexos = [];
        foreach ($this->outrosAnexos as $file) {
       $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
       $anexos[] = $file->baseName . '.' . $file->extension;
            }
             // Consulta à base de dados para obter os anexos já armazenados
        $query = new Query();
        $existingAnexos = $query->select('outrosAnexos')
                                ->from('event')
                                ->where(['Id' => $this->Id])
                                ->scalar();
        // Concatenar os anexos existentes com os novos anexos
        if ($existingAnexos) {
            $existingAnexosArray = explode(',', $existingAnexos);
            $anexos = array_merge($existingAnexosArray, $anexos);
        }

        $this->outrosAnexos = implode(',', $anexos);
    }         
       return true;
    }

    /**
     * Gets query for [[Comuna]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComuna() {
        return $this->hasOne(Comuna::class, ['Id' => 'comunaID']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio() {
        return $this->hasOne(Municipio::class, ['Id' => 'municipioID']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia() {
        return $this->hasOne(Provincia::class, ['Id' => 'provinciaID']);
    }

    public static function getFilteredEvents($entidadesSelecionadas, $provinciasSelecionadas, $areasSelecionadas, $dataInicio = null, $dataFim = null) {
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
