<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\MerchantProfileStorage\Plugin;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Generated\Shared\Transfer\UrlStorageResourceMapTransfer;
use Generated\Shared\Transfer\UrlStorageTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\UrlStorage\Dependency\Plugin\UrlStorageResourceMapperPluginInterface;
use Spryker\Shared\MerchantProfileStorage\MerchantProfileStorageConfig;

/**
 * @method \Spryker\Client\MerchantProfileStorage\MerchantProfileStorageFactory getFactory()
 */
class UrlStorageMerchantProfileMapperPlugin extends AbstractPlugin implements UrlStorageResourceMapperPluginInterface
{
    protected const KEY_ID_MERCHANT = 'id';
    protected const KEY_ID_MERCHANT_PROFILE = 'id_merchant_profile';

    /**
     * @param \Generated\Shared\Transfer\UrlStorageTransfer $urlStorageTransfer
     * @param array $options
     *
     * @return \Generated\Shared\Transfer\UrlStorageResourceMapTransfer
     */
    public function map(UrlStorageTransfer $urlStorageTransfer, array $options = []): UrlStorageResourceMapTransfer
    {
        $urlStorageResourceMapTransfer = new UrlStorageResourceMapTransfer();
        $idMerchantProfile = $urlStorageTransfer->getFkResourceMerchantProfile();

        if ($idMerchantProfile === null) {
            return $urlStorageResourceMapTransfer;
        }

        $merchantProfileMap = $this->getFactory()
            ->getStorageClient()
            ->get($this->generateKey(static::KEY_ID_MERCHANT_PROFILE . ':' . $idMerchantProfile));
        if (isset($merchantProfileMap[static::KEY_ID_MERCHANT])) {
            $resourceKey = $this->generateKey($merchantProfileMap[static::KEY_ID_MERCHANT]);
            $urlStorageResourceMapTransfer->setResourceKey($resourceKey);
            $urlStorageResourceMapTransfer->setType(MerchantProfileStorageConfig::MERCHANT_PROFILE_RESOURCE_NAME);
        }

        return $urlStorageResourceMapTransfer;
    }

    /**
     * @param string $reference
     *
     * @return string
     */
    protected function generateKey(string $reference): string
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer->setReference($reference);

        return $this->getFactory()
            ->getSynchronizationService()
            ->getStorageKeyBuilder(MerchantProfileStorageConfig::MERCHANT_PROFILE_RESOURCE_NAME)
            ->generateKey($synchronizationDataTransfer);
    }
}
