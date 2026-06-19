<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Repositories;

use Panda\WpMembersPay\Database\Tables\MembershipBenefitsTable;
use Panda\WpMembersPay\Membership\Contracts\MembershipBenefitRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipBenefitDto;

final class MembershipBenefitRepository extends AbstractRepository implements MembershipBenefitRepositoryInterface
{
    public function findById(int $id): ?MembershipBenefitDto
    {
        $row = $this->findOneById($id);

        return $row !== null
            ? $this->mapRowToDto($row)
            : null;
    }

    /**
     * @return MembershipBenefitDto[]
     */
    public function findByPlanId(int $planId): array
    {
        $rows = $this->wpdb->get_results(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE plan_id = %%d ORDER BY id ASC',
                    $this->getTableName()
                ),
                $planId
            ),
            ARRAY_A
        );

        return array_map(
            fn(array $row): MembershipBenefitDto => $this->mapRowToDto($row),
            $rows
        );
    }

    public function save(MembershipBenefitDto $benefit): int
    {
        $data = [
            'plan_id'       => $benefit->planId,
            'benefit_key'   => $benefit->benefitKey,
            'benefit_value' => $benefit->benefitValue,
            'description'   => $benefit->description,
            'updated_at'    => $this->now(),
        ];

        if ($benefit->id !== null) {
            $this->update(
                $data,
                [
                    'id' => $benefit->id,
                ]
            );

            return $benefit->id;
        }

        $data['created_at'] = $this->now();

        return $this->insert($data);
    }

    public function delete(int $id): bool
    {
        return $this->deleteRow([
            'id' => $id,
        ]);
    }

    protected function getTableName(): string
    {
        return $this->wpdb->prefix
            . MembershipBenefitsTable::TABLE_NAME;
    }

    /**
     * @param array<string,mixed> $row
     */
    private function mapRowToDto(array $row): MembershipBenefitDto
    {
        return new MembershipBenefitDto(
            id: (int) $row['id'],
            planId: (int) $row['plan_id'],
            benefitKey: (string) $row['benefit_key'],
            benefitValue: (string) $row['benefit_value'],
            description: $row['description'] !== null
                ? (string) $row['description']
                : null,
        );
    }
}
