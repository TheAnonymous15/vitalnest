<?php
/**
 * Packages Service - Package Controller
 */

namespace PackagesService\Controllers;

use PackagesService\Models\Package;

class PackageController
{
    /**
     * Get all packages (public)
     */
    public function index(): array
    {
        $packages = Package::all(true); // Only active packages

        return [
            'success' => true,
            'data' => array_map(fn($p) => $p->toArray(), $packages)
        ];
    }

    /**
     * Get all packages (admin - including inactive)
     */
    public function adminIndex(): array
    {
        $packages = Package::all(false); // All packages

        return [
            'success' => true,
            'data' => array_map(fn($p) => $p->toArray(), $packages)
        ];
    }

    /**
     * Get single package by ID
     */
    public function show(int $id): array
    {
        $package = Package::find($id);

        if (!$package) {
            http_response_code(404);
            return ['success' => false, 'message' => 'Package not found'];
        }

        return [
            'success' => true,
            'data' => $package->toArray()
        ];
    }

    /**
     * Get single package by slug
     */
    public function showBySlug(string $slug): array
    {
        $package = Package::findBySlug($slug);

        if (!$package) {
            http_response_code(404);
            return ['success' => false, 'message' => 'Package not found'];
        }

        return [
            'success' => true,
            'data' => $package->toArray()
        ];
    }

    /**
     * Create new package (admin)
     */
    public function store(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate required fields
        if (empty($data['name']) || empty($data['slug']) || !isset($data['price'])) {
            http_response_code(400);
            return ['success' => false, 'message' => 'Name, slug, and price are required'];
        }

        // Check if slug already exists
        if (Package::findBySlug($data['slug'])) {
            http_response_code(400);
            return ['success' => false, 'message' => 'Package with this slug already exists'];
        }

        try {
            $package = Package::create($data);

            // Add features if provided
            if (!empty($data['features'])) {
                $package->syncFeatures($data['features']);
            }

            return [
                'success' => true,
                'message' => 'Package created successfully',
                'data' => $package->toArray()
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Update package (admin)
     */
    public function update(int $id): array
    {
        $package = Package::find($id);

        if (!$package) {
            http_response_code(404);
            return ['success' => false, 'message' => 'Package not found'];
        }

        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $package->update($data);

            // Sync features if provided
            if (isset($data['features'])) {
                $package->syncFeatures($data['features']);
            }

            // Refresh package data
            $package = Package::find($id);

            return [
                'success' => true,
                'message' => 'Package updated successfully',
                'data' => $package->toArray()
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Delete package (admin)
     */
    public function destroy(int $id): array
    {
        $package = Package::find($id);

        if (!$package) {
            http_response_code(404);
            return ['success' => false, 'message' => 'Package not found'];
        }

        try {
            $package->delete();

            return [
                'success' => true,
                'message' => 'Package deleted successfully'
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Toggle package active status (admin)
     */
    public function toggleStatus(int $id): array
    {
        $package = Package::find($id);

        if (!$package) {
            http_response_code(404);
            return ['success' => false, 'message' => 'Package not found'];
        }

        $package->update(['is_active' => !$package->is_active]);
        $package = Package::find($id);

        return [
            'success' => true,
            'message' => 'Package status updated',
            'data' => $package->toArray()
        ];
    }

    /**
     * Reorder packages (admin)
     */
    public function reorder(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['order']) || !is_array($data['order'])) {
            http_response_code(400);
            return ['success' => false, 'message' => 'Order array is required'];
        }

        try {
            foreach ($data['order'] as $index => $packageId) {
                $package = Package::find($packageId);
                if ($package) {
                    $package->update(['sort_order' => $index + 1]);
                }
            }

            return [
                'success' => true,
                'message' => 'Packages reordered successfully'
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Add feature to package (admin)
     */
    public function addFeature(int $packageId): array
    {
        $package = Package::find($packageId);

        if (!$package) {
            http_response_code(404);
            return ['success' => false, 'message' => 'Package not found'];
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['title'])) {
            http_response_code(400);
            return ['success' => false, 'message' => 'Feature title is required'];
        }

        try {
            $featureId = $package->addFeature($data);
            $package->loadFeatures();

            return [
                'success' => true,
                'message' => 'Feature added successfully',
                'data' => ['feature_id' => $featureId, 'features' => $package->features]
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Update feature (admin)
     */
    public function updateFeature(int $featureId): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['title'])) {
            http_response_code(400);
            return ['success' => false, 'message' => 'Feature title is required'];
        }

        try {
            Package::updateFeature($featureId, $data);

            return [
                'success' => true,
                'message' => 'Feature updated successfully'
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Delete feature (admin)
     */
    public function deleteFeature(int $featureId): array
    {
        try {
            Package::deleteFeature($featureId);

            return [
                'success' => true,
                'message' => 'Feature deleted successfully'
            ];
        } catch (\Exception $e) {
            http_response_code(500);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

