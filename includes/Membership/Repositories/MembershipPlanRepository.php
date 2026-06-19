  <?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Repositories;

use Panda\WpMembersPay\Database\Tables\MembershipPlansTable;
use Panda\WpMembersPay\Membership\Contracts\MembershipPlanRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipPlanDto;

final class MembershipPlanRepository extends AbstractRepository implements MembershipPlanRepositoryInterface
{
    public function findById(int $id): ?MembershipPlanDto
    {
        $row = $this->findOneById($id);

        return $row !== null
            ? $this->mapRowToDto($row)
            : null;
    }

    public function findBySlug(string $slug): ?MembershipPlanDto
    {
        $row = $this->wpdb->get_row(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE slug = %%s',
                    $this->getTableName()
                ),
                $slug
            ),
            ARRAY_A
        );

        return is_array($row)
            ? $this->mapRowToDto($row)
            : null;
    }

    /**
     * @return MembershipPlanDto[]
     */
    public function findAll(): array
    {
        $rows = $this->findAllRows(
            'sort_order ASC, id ASC'
        );

        return array_map(
            fn(array $row): MembershipPlanDto => $this->mapRowToDto($row),
            $rows
        );
    }

    /**
     * @return MembershipPlanDto[]
     */
    public function findActive(): array
    {
        $rows = $this->wpdb->get_results(
            sprintf(
                'SELECT * FROM %s WHERE is_active = 1 ORDER BY sort_order ASC, id ASC',
                $this->getTableName()
            ),
            ARRAY_A
        );

        return array_map(
            fn(array $row): MembershipPlanDto => $this->mapRowToDto($row),
            $rows
        );
    }

    public function save(MembershipPlanDto $plan): int
    {
        $data = [
            'name'          => $plan->name,
            'slug'          => $plan->slug,
            'description'   => $plan->description,
            'price'         => $plan->price,
            'currency'      => $plan->currency,
            'duration_days' => $plan->durationDays,
            'sort_order'    => $plan->sortOrder,
            'is_active'     => $plan->isActive ? 1 : 0,
            'updated_at'    => $this->now(),
        ];

        if ($plan->id !== null) {
            $this->update(
                $data,
                ['id' => $plan->id]
            );

            return $plan->id;
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
            . MembershipPlansTable::TABLE_NAME;
    }

    /**
     * @param array<string,mixed> $row
     */
    private function mapRowToDto(array $row): MembershipPlanDto
    {
        return new MembershipPlanDto(
            id: (int) $row['id'],
            name: (string) $row['name'],
            slug: (string) $row['slug'],
            description: (string) ($row['description'] ?? ''),
            price: (float) $row['price'],
            currency: (string) $row['currency'],
            durationDays: (int) $row['duration_days'],
            sortOrder: (int) $row['sort_order'],
            isActive: (int) $row['is_active'] === 1,
        );
    }
}
