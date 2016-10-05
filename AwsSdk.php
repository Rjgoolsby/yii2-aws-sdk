<?php
/**
 * @copyright Federico Nicolás Motta
 * @author Federico Nicolás Motta <fedemotta@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License (MIT)
 * @package yii2-aws-sdk
 */
namespace fedemotta\awssdk;
use yii\base\Component;
use Aws;
use Aws\S3\S3Client;

/**
 * Yii2 component wrapping of the AWS SDK for easy configuration
 * @author Federico Nicolás Motta <fedemotta@gmail.com>
 */
class AwsSdk extends Component
{
    /*
     * @var array specifies the AWS credentials
     */
    public $credentials = [];
    
    /*
     * @var string specifies the AWS region
     */
    public $region = null;
    
    /*
     * @var string specifies the AWS version
     */
    public $version = null;
    
    /*
     * @var array specifies extra params
     */
    public $extra = [];

    protected $options;
    
    /**
     * @var AWS SDK instance
     */
    protected $_awssdk;

    public function init(){
        $this->options = array_merge([ 
            'credentials' => $this->credentials,
            'region'=>$this->region,
            'version'=>$this->version
        ],$this->extra);
        parent::init();
    }
    
    /**
     * Initializes (if needed) and fetches the AWS SDK instance
     * @return Aws instance
     */
    public function getAwsSdk()
    {
        if (empty($this->_awssdk) || !$this->_awssdk instanceof Aws\Sdk) {
            $this->setAwsSdk();
        }
        return $this->_awssdk;
    }
    /**
     * Sets the AWS SDK instance
     */
    public function setAwsSdk()
    {
        $this->_awssdk = new Aws\Sdk($this->options);
    }

    public function getS3($arg=[]){
        return new S3Client($this->options);
    }
}
