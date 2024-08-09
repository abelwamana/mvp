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
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }
//     public $outrosAnexos;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
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
            'agenda' => Yii::t('app', 'Agenda'),
            'listaConvidados' => Yii::t('app', 'Lista de Convidados'),
            'pada' => Yii::t('app', 'PADA (UIC FRESAN/Camões, I.P.)'),
            'listaParticipantes' => Yii::t('app', 'Lista de Participantes'),
            'actaRelatorio' => Yii::t('app', 'Acta/Relatório'),
            'outrosAnexos' => Yii::t('app', 'Outros Anexos (ppt, video, imagem, documento ou planilha)'),
        ];
    }

//    public function uploadFiles()
//    {
//        $uploadDir = Yii::getAlias('@backend/web/uploads');
//        if (!file_exists($uploadDir)) {
//            mkdir($uploadDir, 0777, true);
//        }
//
//        $fileAttributes = ['agenda', 'listaConvidados', 'pada', 'actaRelatorio', 'listaParticipantes'];
//        foreach ($fileAttributes as $fileAttr) {
//            if ($this->$fileAttr) {
//                $filePath = $uploadDir . DIRECTORY_SEPARATOR . $this->$fileAttr->baseName . '.' . $this->$fileAttr->extension;
//                if (!$this->$fileAttr->saveAs($filePath)) {
//                    $this->addError($fileAttr, 'Erro ao carregar o arquivo.');
//                    return false;
//                }
//                $this->$fileAttr = $filePath;
//            }
//        }
//        return true;
//    }
    public function uploadFiles()
{
    $uploadDir = Yii::getAlias('uploads');
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    if ($this->validate()) {
            $this->agenda->saveAs('uploads/' . $this->agenda->baseName . '.' . $this->agenda->extension);
            return true;
        } else {
            return false;
        }

         // Verificar se a pasta de upload existe, caso contrário, criá-la
//        if (!is_dir($uploadPath)) {
//            if (!mkdir($uploadPath, 0777, true) && !is_dir($uploadPath)) {
//                Yii::error('Failed to create upload directory: ' . $uploadPath, __METHOD__);
//                return false;
//            }
//        }

        // Salvar arquivos individuais
//    if ($this->agenda instanceof UploadedFile && !empty($this->agenda)) {
//        $filePath = $uploadPath . $this->agenda->baseName . '.' . $this->agenda->extension;
//        if ($this->agenda->saveAs($filePath)) {
//            $this->agenda = $this->agenda->baseName . '.' . $this->agenda->extension;
//            Yii::info('Saved agenda to: ' . $filePath, __METHOD__);
//        } else {
//            Yii::error('Failed to save agenda to: ' . $filePath, __METHOD__);
//        }
//    }
//    
//    if ($this->listaConvidados instanceof UploadedFile && !empty($this->listaConvidados)) {
//        $filePath = $uploadPath . $this->listaConvidados->baseName . '.' . $this->listaConvidados->extension;
//        if ($this->listaConvidados->saveAs($filePath)) {
//            $this->listaConvidados = $this->listaConvidados->baseName . '.' . $this->listaConvidados->extension;
//            Yii::info('Saved listaConvidados to: ' . $filePath, __METHOD__);
//        } else {
//            Yii::error('Failed to save listaConvidados to: ' . $filePath, __METHOD__);
//        }
//    }
//    
//      if ($this->actaRelatorio instanceof UploadedFile && !empty($this->actaRelatorio)) {
//        $filePath = $uploadPath . $this->actaRelatorio->baseName . '.' . $this->actaRelatorio->extension;
//        if ($this->actaRelatorio->saveAs($filePath)) {
//            $this->actaRelatorio = $this->actaRelatorio->baseName . '.' . $this->actaRelatorio->extension;
//            Yii::info('Saved actaRelatorio to: ' . $filePath, __METHOD__);
//        } else {
//            Yii::error('Failed to save actaRelatorio to: ' . $filePath, __METHOD__);
//        }
//    }

        //    if ($this->listaParticipantes instanceof UploadedFile && !empty($this->listaParticipantes)) {
//        $filePath = $uploadPath . $this->listaParticipantes->baseName . '.' . $this->listaParticipantes->extension;
//        if ($this->listaParticipantes->saveAs($filePath)) {
//            $this->listaParticipantes = $this->listaParticipantes->baseName . '.' . $this->listaParticipantes->extension;
//            Yii::info('Saved listaParticipantes to: ' . $filePath, __METHOD__);
//        } else {
//            Yii::error('Failed to save listaParticipantes to: ' . $filePath, __METHOD__);
//        }
//    }
//    
//    //    
        // Salvar arquivos múltiplos
//        if (is_array($this->outrosAnexos) && !empty($this->outrosAnexos) && $this->outrosAnexos != "A confirmar") {
//            $anexos = [];
//            foreach ($this->outrosAnexos as $file) {
//                if ($file instanceof UploadedFile) {
//                    $filePath = $uploadPath . $file->baseName . '.' . $file->extension;
//                        if ($file->saveAs($filePath)) {
//                            $anexos[] = $file->baseName . '.' . $file->extension;
//
////            $this->listaConvidados->saveAs('uploads/' . $this->listaConvidados->baseName . '.' . $this->listaConvidados->extension);
//                            return true;
//                        }
//                    } else {
//                        return false;
//                    }
//                }
//            $this->outrosAnexos = implode(',', $anexos);
//        }
//    
//    //    if ($this->pada instanceof UploadedFile && !empty($this->pada)) {
//        $filePath = $uploadPath . $this->pada->baseName . '.' . $this->pada->extension;
//        if ($this->pada->saveAs($filePath)) {
//            $this->pada = $this->pada->baseName . '.' . $this->pada->extension;
//            Yii::info('Saved pada to: ' . $filePath, __METHOD__);
//        } else {
//            Yii::error('Failed to save pada to: ' . $filePath, __METHOD__);
//        }
//    }
//    
//    $fileAttributes = ['agenda', 'listaConvidados', 'pada', 'actaRelatorio', 'listaParticipantes'];
//    foreach ($fileAttributes as $fileAttr) {
//        if ($this->$fileAttr) {
//            $filePath = $this->$fileAttr->baseName . '.' . $this->$fileAttr->extension;
//            if (!$this->$fileAttr->saveAs($filePath)) {
//                $this->addError($fileAttr, 'Erro ao carregar o arquivo.');
//                return false;
//            }
//            $this->$fileAttr = $filePath;
//        }
//    }
//
//    // Upload de múltiplos arquivos
//   if ($this->outrosAnexos!="A confirmar") {
//    if ($this->outrosAnexos) {
//        $outrosAnexosPaths = [];
//        foreach ($this->outrosAnexos as $file) {
//            $filePath = $file->baseName . '.' . $file->extension;
//            if (!$file->saveAs($filePath)) {
//                $this->addError('outrosAnexos', 'Erro ao carregar o arquivo.');
//                return false;
//            }
//            $outrosAnexosPaths[] = $filePath;
//        }
//        // Serializa os caminhos dos arquivos para salvar na base de dados
//        $this->outrosAnexos = implode(',', $outrosAnexosPaths);
//    }
//   }
//    return true;
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
