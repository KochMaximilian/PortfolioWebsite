<?php

return function ($page) {


    $filterBy = get('filter');
    $unfilterd = collection('projects')->sortBy('year', 'desc');

    $projects = $unfilterd
        ->when($filterBy, function ($filterBy) {
            return $this->filterBy('year', $filterBy);
        })
        ->paginate(6);

    $pagination = $projects->pagination();
    $filters = $unfilterd->pluck('year', null, true); /* unique values = true */

    return [
        'filterBy' => $filterBy,
        'unfilterd' => $unfilterd,
        'projects' => $projects,
        'pagination' => $pagination,
        'filters' => $filters
    ];
};
