<?php


namespace Naugrim\BMEcat\Nodes;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;

/**
 *
 * @Serializer\XmlRoot("PRODUCT")
 */
class Product implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("mode")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $mode = 'new';

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\SupplierPid")
     * @Serializer\SerializedName("SUPPLIER_PID")
     *
     * @var SupplierPid
     */
    protected $id;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PRODUCT_DETAILS")
     * @Serializer\Type("Naugrim\BMEcat\Nodes\ProductDetails")
     *
     * @var ProductDetails
     */
    protected $details;


    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\ProductFeatures>")
     * @Serializer\XmlList( inline=true, entry="PRODUCT_FEATURES")
     *
     * @var ProductFeatures[]
     */
    protected $features = [];

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("PRODUCT_ORDER_DETAILS")
     * @Serializer\Type("Naugrim\BMEcat\Nodes\ProductOrderDetails")
     *
     * @var ProductOrderDetails
     */
    protected $orderDetails;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PRODUCT_PRICE_DETAILS")
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\ProductPriceDetails>")
     * @Serializer\XmlList(inline = true, entry = "PRODUCT_PRICE_DETAILS")
     *
     * @var ProductPrice[]
     */
    protected $priceDetails = [];

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("MIME_INFO")
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Mime>")
     * @Serializer\XmlList( entry="MIME")
     *
     * @var Mime[]
     */
    protected $mimes = [];

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }


    /**
     *
     * @param ProductDetails $details
     * @return Product
     */
    public function setDetails(ProductDetails $details) : Product
    {
        $this->details = $details;
        return $this;
    }

    /**
     *
     * @return ProductDetails
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     *
     * @param ProductPrice[] $priceDetails
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPriceDetails(array $priceDetails) : Product
    {
        $this->priceDetails = [];
        foreach ($priceDetails as $priceDetail) {
            if (is_array($priceDetail)) {
                $priceDetail = NodeBuilder::fromArray($priceDetail, new ProductPriceDetails());
            }
            $this->addPriceDetail($priceDetail);
        }
        return $this;
    }

    /**
     *
     * @param ProductPriceDetails $price
     * @return Product
     */
    public function addPriceDetail(ProductPriceDetails $price) : Product
    {
        if ($this->priceDetails === null) {
            $this->priceDetails = [];
        }
        $this->priceDetails[] = $price;
        return $this;
    }

    /**
     * @param Mime[] $mimes
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setMimes(array $mimes): Product
    {
        $this->mimes = [];
        foreach ($mimes as $mime) {
            if (is_array($mime)) {
                $mime = NodeBuilder::fromArray($mime, new Mime());
            }
            $this->addMime($mime);
        }
        return $this;
    }

    /**
     * @param Mime $mime
     * @return Product
     */
    public function addMime(Mime $mime) : Product
    {
        if ($this->mimes === null) {
            $this->mimes = [];
        }
        $this->mimes[] = $mime;
        return $this;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Product
     */
    public function nullPriceDetails() : Product
    {
        if (empty($this->priceDetails) === true) {
            $this->priceDetails = null;
        }
        return $this;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Product
     */
    public function nullMime() : Product
    {
        if (empty($this->mimes) === true) {
            $this->mimes = null;
        }
        return $this;
    }

    /**
     *
     * @param SupplierPid $id
     * @return Product
     */
    public function setId(SupplierPid $id) : Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ProductOrderDetails|null
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    /**
     * @param ProductOrderDetails $orderDetails
     * @return Product
     */
    public function setOrderDetails(ProductOrderDetails $orderDetails) : Product
    {
        $this->orderDetails = $orderDetails;
        return $this;
    }

    /**
     *
     * @return SupplierPid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Product
     */
    public function nullFeatures() : Product
    {
        if (empty($this->features) === true) {
            $this->features = null;
        }

        return $this;
    }

    /**
     * @param ProductFeatures[] $features
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setFeatures(array $features): Product
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (is_array($feature)) {
                $feature = NodeBuilder::fromArray($feature, new ProductFeatures());
            }
            $this->addFeatures($feature);
        }
        return $this;
    }

    /**
     *
     * @param ProductFeatures $features
     * @return Product
     */
    public function addFeatures(ProductFeatures $features) : Product
    {
        if ($this->features === null) {
            $this->features = [];
        }
        $this->features [] = $features;
        return $this;
    }

    /**
     *
     * @return ProductFeatures[]
     */
    public function getFeatures()
    {
        if ($this->features === null) {
            return [];
        }

        return $this->features;
    }

    /**
     *
     * @return ProductPrice[]
     */
    public function getPriceDetails()
    {
        if ($this->priceDetails === null) {
            return [];
        }

        return $this->priceDetails;
    }

    /**
     * @return Mime[]|null
     */
    public function getMimes()
    {
        return $this->mimes;
    }
}
