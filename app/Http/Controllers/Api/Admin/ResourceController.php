<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Contracts\Repositories\SingleKeyModelRepositoryInterface;
use App\Exceptions\Api\Admin\APIErrorException;
use App\Http\Requests\Api\Admin\Request;
use App\Http\Requests\Api\Admin\ResourceUpdate;
use App\Http\Resources\Api\Admin\Resource;
use App\Http\Resources\Api\Admin\Resources;
use App\Http\Resources\Api\Admin\Status;

class ResourceController extends BaseController
{
    protected SingleKeyModelRepositoryInterface $repository;

    public function index(Request $request): Resources
    {
        $offset = (int) $request->query('_start', '0');
        $end = (int) $request->query('_end', '100');
        $limit = $end - $offset;

        $directionString = $request->query('_order', 'asc');
        $directions = explode(',', $directionString);
        $orderString = $request->query('_sort', 'id');
        $orders = explode(',', $orderString);

        $filter = $request->query('_filter', '');
        $filterArray = [];
        if ($filter !== '') {
            $filterArray = ['query' => $filter];
        }

        foreach ($directions as $index => $direction) {
            if ($direction !== 'desc') {
                $direction = 'asc';
            }
            $directions[$index] = $direction;
        }

        if (count($directions) !== count($orders)) {
            $orders = ['id'];
            $directions = ['asc'];
        }

        $resources = $this->repository->getByFilter($filterArray, $orders, $directions, $offset, $limit);
        $count = $this->repository->countByFilter($filterArray);

        return new Resources([
            'resources' => $resources,
            'count' => $count,
        ]);
    }

    /**
     * @throws APIErrorException
     */
    public function show(string $id): Resource
    {
        $resource = $this->repository->find($id);
        if (empty($resource)) {
            throw new APIErrorException("Resource ID:{$id} not found", 404);
        }

        return new Resource($resource);
    }

    /**
     * @throws APIErrorException
     */
    public function store(ResourceUpdate $request): Resource
    {
        $resource = $this->repository->create($request->all());
        if (empty($resource)) {
            throw new APIErrorException('Server error has happened on creation', 500);
        }

        return (new Resource($resource))->withStatus(201);
    }

    /**
     * @throws APIErrorException
     */
    public function update(ResourceUpdate $request, string $id): Resource
    {
        $resource = $this->repository->find($id);
        if (empty($resource)) {
            throw new APIErrorException("Resource ID:{$id} not found", 404);
        }

        $resource = $this->repository->update($resource, $request->all());
        if (empty($resource)) {
            throw new APIErrorException('Server error has happened on updating', 500);
        }

        return new Resource($resource);
    }

    /**
     * @throws APIErrorException
     */
    public function destroy(string $id): Status
    {
        $resource = $this->repository->find($id);
        if (empty($resource)) {
            throw new APIErrorException("Resource ID:{$id} not found", 404);
        }
        $this->repository->delete($resource);

        return Status::ok('Resource successfully deleted');
    }
}
