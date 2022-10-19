<?php

namespace Despawn\Filament\Components;

use Closure;
use Despawn\Models\Role;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\BouncerFacade as Bouncer;

class PermissionToggle extends Toggle
{
    protected string | Closure | null $ability = null;

    protected Closure | Model | null $role = null;

    public function permissionToggle(string | Closure $ability, Model | string | Closure | null $model = null)
    {
        $this->loadStateFromRelationshipsUsing(static function (Toggle $component, ?bool $state) use ($ability, $model): void {
            $role = $component->getRecord();

            isset($model) ? $component->state($role->can($ability, $model)) : $component->state($role->can($ability));
        });

        $this->saveRelationshipsUsing(static function (Toggle $component, ?bool $state) use ($ability, $model) {
            $record = $component->getRecord();

            if ($record instanceof Role) {
                match ((bool) $state) {
                    true => isset($model) ? Bouncer::allow($record)->to($ability, $model) : Bouncer::allow($record)->to($ability),
                    false => isset($model) ? Bouncer::disallow($record)->to($ability, $model) : Bouncer::disallow($record)->to($ability)
                };
            }
        });

        $this->dehydrated(false);

        return $this;
    }
}
