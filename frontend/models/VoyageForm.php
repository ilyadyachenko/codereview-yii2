<?php
namespace frontend\models;

use common\models\Transportation;
use common\models\Voyage;
use common\services\VoyageService;
use yii\base\Model;


/**
 * Voyage Form
 */
class VoyageForm extends Model
{
    public $transportation_id;
    public $phone;
    public $date_load;
    public $date_unload;
    public $weight;

	private $voyage;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
	        [['transportation_id', 'phone'], 'required'],
	        [['transportation_id'], 'integer'],
	        [['weight'], 'number'],
	        [['date_load', 'date_unload'], 'safe'],
	        [['phone'], 'string', 'max' => 15],
	        [['transportation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transportation::className(), 'targetAttribute' => ['transportation_id' => 'id']],[['date_load'], 'validateDates'],
        ];
    }

	public function validateDates()
	{
		if(strtotime($this->date_load) > strtotime($this->date_unload))
		{
			$this->addError('date_load','Please give correct Date load and unload dates');
			$this->addError('date_unload','Please give correct Date load and unload dates');
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'transportation_id' => 'Перевозка',
			'date_load' => 'Дата загрузки',
			'date_unload' => 'Дата выгрузки',
			'phone' => 'Телефон водителя',
			'weight' => 'Перевозимый вес',
		];
	}

	public function setTransportationId($transportationId)
	{
		$this->transportation_id = $transportationId;
	}

	/**
	 * @param null $attributeNames
	 * @param bool $clearErrors
	 * @return bool
	 */
	public function validate($attributeNames = null, $clearErrors = true)
	{
		if (!parent::validate())
		{
			return null;
		}

		$voyage = $this->createEntity();

		if (VoyageService::getLeftWeightByVoyage($voyage) <= 0)
		{
			$this->addError('weight', 'Not available weight');
		}

		return !$this->hasErrors();
	}

	/**
	 * @return bool
	 */
	public function save()
	{
		if (!$this->validate())
		{
			return null;
		}

		return $this->createEntity()->save();
	}

	/**
	 * @return Voyage
	 */
	private function createEntity(): Voyage
	{
		$voyage = new Voyage();
		$voyage->setAttributes([
			                       'transportation_id' => $this->transportation_id,
			                       'date_load' => $this->date_load,
			                       'date_unload' => $this->date_unload,
			                       'phone' => $this->phone,
			                       'weight' => $this->weight,
		                       ]);

		$this->voyage = $voyage;
		return $voyage;
	}

}
