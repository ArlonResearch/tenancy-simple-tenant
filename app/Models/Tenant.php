<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant as ContractsTenant;
use Tenancy\Identification\Drivers\Queue\Contracts\IdentifiesByQueue;
use Tenancy\Identification\Drivers\Queue\Events\Processing;

class Tenant extends Model implements ContractsTenant, IdentifiesByQueue
{
    use AllowsTenantIdentification;
    use HasFactory;

    public function tenantIdentificationByQueue(Processing $event): ?ContractsTenant
    {
        dump([
            $event->tenant_key,
            $event->tenant_identifier,
        ]);

        if ($this->getTenantIdentifier() === $event->tenant_identifier) {
            return $this->newQuery()->where($this->getKeyName(), $event->tenant_key)->sole();
        }

        return null;
    }
}
