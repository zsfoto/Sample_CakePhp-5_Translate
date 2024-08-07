<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Langs Model
 *
 * @method \App\Model\Entity\Lang newEmptyEntity()
 * @method \App\Model\Entity\Lang newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Lang> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lang get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Lang findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Lang patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Lang> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lang|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Lang saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Lang>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lang>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lang>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lang> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lang>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lang>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lang>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lang> deleteManyOrFail(iterable $entities, array $options = [])
 */
class LangsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('langs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        //$this->hasMany('Articles', [
        //    'foreignKey' => 'lang_id',
        //]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('lang')
            ->maxLength('lang', 6)
            ->requirePresence('lang', 'create')
            ->notEmptyString('lang')
            ->add('lang', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('visible')
            ->requirePresence('visible', 'create')
            ->notEmptyString('visible');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['lang']), ['errorField' => 'lang']);
        $rules->add($rules->isUnique(['name', 'lang']), ['errorField' => 'name']);

        return $rules;
    }
}
