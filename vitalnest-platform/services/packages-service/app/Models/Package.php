<?php
/**
 * Packages Service - Package Model
 */

namespace PackagesService\Models;

class Package
{
    private static ?\PDO $db = null;

    public int $id;
    public string $name;
    public string $slug;
    public ?string $description;
    public float $price;
    public string $currency;
    public int $duration_value;
    public string $duration_unit;
    public string $icon;
    public string $color;
    public string $gradient_from;
    public string $gradient_to;
    public ?string $badge;
    public string $badge_color;
    public bool $is_popular;
    public bool $is_active;
    public int $sort_order;
    public string $cta_text;
    public string $cta_link;
    public string $created_at;
    public string $updated_at;
    public array $features = [];

    private static function getDb(): \PDO
    {
        if (self::$db === null) {
            $config = require __DIR__ . '/../../config/service.php';
            self::$db = new \PDO("sqlite:{$config['database']['path']}");
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$db;
    }

    /**
     * Get all active packages with features
     */
    public static function all(bool $activeOnly = true): array
    {
        $db = self::getDb();
        $sql = "SELECT * FROM packages";
        if ($activeOnly) {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " ORDER BY sort_order ASC";

        $stmt = $db->query($sql);
        $packages = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $package = self::hydrate($row);
            $package->loadFeatures();
            $packages[] = $package;
        }

        return $packages;
    }

    /**
     * Find package by ID
     */
    public static function find(int $id): ?self
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM packages WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) return null;

        $package = self::hydrate($row);
        $package->loadFeatures();
        return $package;
    }

    /**
     * Find package by slug
     */
    public static function findBySlug(string $slug): ?self
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM packages WHERE slug = ?");
        $stmt->execute([$slug]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) return null;

        $package = self::hydrate($row);
        $package->loadFeatures();
        return $package;
    }

    /**
     * Create new package
     */
    public static function create(array $data): self
    {
        $db = self::getDb();

        $stmt = $db->prepare("
            INSERT INTO packages (name, slug, description, price, currency, duration_value, duration_unit,
                                  icon, color, gradient_from, gradient_to, badge, badge_color,
                                  is_popular, is_active, sort_order, cta_text, cta_link, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))
        ");

        $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'] ?? null,
            $data['price'],
            $data['currency'] ?? 'KES',
            $data['duration_value'] ?? 1,
            $data['duration_unit'] ?? 'month',
            $data['icon'] ?? 'fa-box',
            $data['color'] ?? 'teal',
            $data['gradient_from'] ?? 'teal-500',
            $data['gradient_to'] ?? 'teal-700',
            $data['badge'] ?? null,
            $data['badge_color'] ?? 'teal',
            $data['is_popular'] ?? 0,
            $data['is_active'] ?? 1,
            $data['sort_order'] ?? 0,
            $data['cta_text'] ?? 'Get Started',
            $data['cta_link'] ?? '/patient'
        ]);

        return self::find($db->lastInsertId());
    }

    /**
     * Update package
     */
    public function update(array $data): bool
    {
        $db = self::getDb();

        $stmt = $db->prepare("
            UPDATE packages SET
                name = ?, slug = ?, description = ?, price = ?, currency = ?,
                duration_value = ?, duration_unit = ?, icon = ?, color = ?,
                gradient_from = ?, gradient_to = ?, badge = ?, badge_color = ?,
                is_popular = ?, is_active = ?, sort_order = ?, cta_text = ?, cta_link = ?,
                updated_at = datetime('now')
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['name'] ?? $this->name,
            $data['slug'] ?? $this->slug,
            $data['description'] ?? $this->description,
            $data['price'] ?? $this->price,
            $data['currency'] ?? $this->currency,
            $data['duration_value'] ?? $this->duration_value,
            $data['duration_unit'] ?? $this->duration_unit,
            $data['icon'] ?? $this->icon,
            $data['color'] ?? $this->color,
            $data['gradient_from'] ?? $this->gradient_from,
            $data['gradient_to'] ?? $this->gradient_to,
            $data['badge'] ?? $this->badge,
            $data['badge_color'] ?? $this->badge_color,
            $data['is_popular'] ?? $this->is_popular,
            $data['is_active'] ?? $this->is_active,
            $data['sort_order'] ?? $this->sort_order,
            $data['cta_text'] ?? $this->cta_text,
            $data['cta_link'] ?? $this->cta_link,
            $this->id
        ]);
    }

    /**
     * Delete package
     */
    public function delete(): bool
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE FROM packages WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    /**
     * Load features for package
     */
    public function loadFeatures(): void
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM package_features WHERE package_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$this->id]);
        $this->features = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Add feature to package
     */
    public function addFeature(array $data): int
    {
        $db = self::getDb();
        $stmt = $db->prepare("
            INSERT INTO package_features (package_id, title, description, icon, icon_color, is_highlighted, sort_order, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, datetime('now'))
        ");

        $stmt->execute([
            $this->id,
            $data['title'],
            $data['description'] ?? null,
            $data['icon'] ?? 'fa-check',
            $data['icon_color'] ?? $this->color,
            $data['is_highlighted'] ?? 0,
            $data['sort_order'] ?? 0
        ]);

        return $db->lastInsertId();
    }

    /**
     * Update feature
     */
    public static function updateFeature(int $featureId, array $data): bool
    {
        $db = self::getDb();
        $stmt = $db->prepare("
            UPDATE package_features SET
                title = ?, description = ?, icon = ?, icon_color = ?, is_highlighted = ?, sort_order = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['title'],
            $data['description'] ?? null,
            $data['icon'] ?? 'fa-check',
            $data['icon_color'] ?? 'teal',
            $data['is_highlighted'] ?? 0,
            $data['sort_order'] ?? 0,
            $featureId
        ]);
    }

    /**
     * Delete feature
     */
    public static function deleteFeature(int $featureId): bool
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE FROM package_features WHERE id = ?");
        return $stmt->execute([$featureId]);
    }

    /**
     * Sync features - replace all features
     */
    public function syncFeatures(array $features): void
    {
        $db = self::getDb();

        // Delete existing features
        $stmt = $db->prepare("DELETE FROM package_features WHERE package_id = ?");
        $stmt->execute([$this->id]);

        // Insert new features
        foreach ($features as $index => $feature) {
            $this->addFeature([
                'title' => $feature['title'],
                'description' => $feature['description'] ?? null,
                'icon' => $feature['icon'] ?? 'fa-check',
                'icon_color' => $feature['icon_color'] ?? $this->color,
                'is_highlighted' => $feature['is_highlighted'] ?? 0,
                'sort_order' => $feature['sort_order'] ?? ($index + 1)
            ]);
        }

        $this->loadFeatures();
    }

    /**
     * Hydrate model from database row
     */
    private static function hydrate(array $data): self
    {
        $package = new self();
        $package->id = (int)$data['id'];
        $package->name = $data['name'];
        $package->slug = $data['slug'];
        $package->description = $data['description'];
        $package->price = (float)$data['price'];
        $package->currency = $data['currency'];
        $package->duration_value = (int)$data['duration_value'];
        $package->duration_unit = $data['duration_unit'];
        $package->icon = $data['icon'];
        $package->color = $data['color'];
        $package->gradient_from = $data['gradient_from'];
        $package->gradient_to = $data['gradient_to'];
        $package->badge = $data['badge'];
        $package->badge_color = $data['badge_color'];
        $package->is_popular = (bool)$data['is_popular'];
        $package->is_active = (bool)$data['is_active'];
        $package->sort_order = (int)$data['sort_order'];
        $package->cta_text = $data['cta_text'];
        $package->cta_link = $data['cta_link'];
        $package->created_at = $data['created_at'];
        $package->updated_at = $data['updated_at'];
        return $package;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'price_formatted' => $this->getFormattedPrice(),
            'currency' => $this->currency,
            'duration_value' => $this->duration_value,
            'duration_unit' => $this->duration_unit,
            'duration_text' => $this->getDurationText(),
            'icon' => $this->icon,
            'color' => $this->color,
            'gradient_from' => $this->gradient_from,
            'gradient_to' => $this->gradient_to,
            'badge' => $this->badge,
            'badge_color' => $this->badge_color,
            'is_popular' => $this->is_popular,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'cta_text' => $this->cta_text,
            'cta_link' => $this->cta_link,
            'features' => $this->features,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    /**
     * Get formatted price (e.g., "25K")
     */
    public function getFormattedPrice(): string
    {
        if ($this->price >= 1000) {
            return number_format($this->price / 1000) . 'K';
        }
        return number_format($this->price);
    }

    /**
     * Get duration text (e.g., "/month", "/trimester")
     */
    public function getDurationText(): string
    {
        if ($this->duration_value == 1) {
            return "/{$this->duration_unit}";
        }
        return "/{$this->duration_value} {$this->duration_unit}s";
    }
}

