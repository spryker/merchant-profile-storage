<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProfileStorage\Persistence;

use Generated\Shared\Transfer\MerchantProfileStorageTransfer;

interface MerchantProfileStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantProfileStorageTransfer $merchantProfileStorageTransfer
     *
     * @return void
     */
    public function saveMerchantProfileStorageEntity(MerchantProfileStorageTransfer $merchantProfileStorageTransfer): void;

    /**
     * @param int[] $merchantProfileIds
     *
     * @return void
     */
    public function deleteMerchantProfileStorageEntitiesByMerchantProfileIds(array $merchantProfileIds): void;
}