<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Client\MerchantProfileStorage;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\MerchantProfileStorage\Dependency\Client\MerchantProfileStorageToStorageClientInterface;
use Spryker\Client\MerchantProfileStorage\Dependency\Service\MerchantProfileStorageConnectorToSynchronizationServiceInterface;
use Spryker\Client\MerchantProfileStorage\Dependency\Service\MerchantProfileStorageToUtilEncodingServiceInterface;
use Spryker\Client\MerchantProfileStorage\Mapper\MerchantProfileStorageMapper;
use Spryker\Client\MerchantProfileStorage\Mapper\MerchantProfileStorageMapperInterface;
use Spryker\Client\MerchantProfileStorage\Mapper\UrlStorageMerchantProfileMapper;
use Spryker\Client\MerchantProfileStorage\Mapper\UrlStorageMerchantProfileMapperInterface;
use Spryker\Client\MerchantProfileStorage\Storage\MerchantProfileStorageReader;
use Spryker\Client\MerchantProfileStorage\Storage\MerchantProfileStorageReaderInterface;

class MerchantProfileStorageFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Client\MerchantProfileStorage\Storage\MerchantProfileStorageReaderInterface
     */
    public function createMerchantProfileStorageReader(): MerchantProfileStorageReaderInterface
    {
        return new MerchantProfileStorageReader(
            $this->createMerchantProfileStorageMapper(),
            $this->getSynchronizationService(),
            $this->getStorageClient(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \Spryker\Client\MerchantProfileStorage\Mapper\MerchantProfileStorageMapperInterface
     */
    public function createMerchantProfileStorageMapper(): MerchantProfileStorageMapperInterface
    {
        return new MerchantProfileStorageMapper();
    }

    /**
     * @return \Spryker\Client\MerchantProfileStorage\Mapper\UrlStorageMerchantProfileMapperInterface
     */
    public function createUrlStorageMerchantProfileMapper(): UrlStorageMerchantProfileMapperInterface
    {
        return new UrlStorageMerchantProfileMapper(
            $this->getSynchronizationService(),
            $this->getStorageClient()
        );
    }

    /**
     * @return \Spryker\Client\MerchantProfileStorage\Dependency\Service\MerchantProfileStorageConnectorToSynchronizationServiceInterface
     */
    public function getSynchronizationService(): MerchantProfileStorageConnectorToSynchronizationServiceInterface
    {
        return $this->getProvidedDependency(MerchantProfileStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    /**
     * @return \Spryker\Client\MerchantProfileStorage\Dependency\Client\MerchantProfileStorageToStorageClientInterface
     */
    public function getStorageClient(): MerchantProfileStorageToStorageClientInterface
    {
        return $this->getProvidedDependency(MerchantProfileStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Spryker\Client\MerchantProfileStorage\Dependency\Service\MerchantProfileStorageToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): MerchantProfileStorageToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(MerchantProfileStorageDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
