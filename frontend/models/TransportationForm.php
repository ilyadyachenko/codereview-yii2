<?php
namespace frontend\models;

use common\models\Request;
use common\models\Transportation;
use common\models\Transporter;
use common\services\RequestService;
use common\services\TransportationService;
use common\services\TransporterService;
use yii\base\Model;


/**
 * Transportation Form
 */
class TransportationForm extends Model
{
    public $request_id;
    public $transporter_id;
    public $weight;

    private $transportation;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
	        [['request_id', 'transporter_id', 'weight'], 'required'],
	        [['request_id', 'transporter_id'], 'integer'],
	        [['weight'], 'number'],
	        [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
	        [['transporter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transporter::className(), 'targetAttribute' => ['transporter_id' => 'id']],
        ];
    }

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'request_id' => 'Заявка',
			'transporter_id' => 'Перевозчик',
			'weight' => 'Перевозимый вес',
		];
	}

	public function setRequestId($requestId)
	{
		$this->request_id = $requestId;
	}

	public function getTransportation()
	{
		return $this->transportation;
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
	 * @return Transportation
	 */
	private function createEntity(): Transportation
	{
		$transportation = new Transportation();
		$transportation->setAttributes([
			                               'request_id' => $this->request_id,
			                               'transporter_id' => $this->transporter_id,
			                               'weight' => $this->weight,
		                               ]);

		$this->transportation = $transportation;
		return $transportation;
	}

}
