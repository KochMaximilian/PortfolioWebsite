<?php

return function ($page) {


    $filterBy = get('filter');
    $unfilterd = collection('projects')->sortBy('featured', 'desc', 'year', 'desc');

    $projects = $unfilterd
        ->when($filterBy, function ($filterBy) {
            return $this->filterBy('year', $filterBy);
        })
        ->paginate(3);

    $pagination = $projects->pagination();
    $filters = array_map('strval', $unfilterd->pluck('year', null, true));
    rsort($filters, SORT_NUMERIC);

    return [
        'filterBy' => $filterBy,
        'unfilterd' => $unfilterd,
        'projects' => $projects,
        'pagination' => $pagination,
        'filters' => $filters
    ];
};
