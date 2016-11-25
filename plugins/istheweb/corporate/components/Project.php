<?php namespace Istheweb\Corporate\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Lang;
use Cms\Classes\Page;
use October\Rain\Support\Collection;
use Istheweb\Corporate\Models\ProjectCategory;
use Istheweb\Corporate\Models\Project as ProjectModel;
use Istheweb\Corporate\Models\Service;

class Project extends ComponentBase
{

    public $project;

    public $categoryPage;

    public $relatedProjects;

    public function componentDetails()
    {
        return [
            'name'        => 'istheweb.corporate::lang.components.project.name',
            'description' => 'istheweb.corporate::lang.components.project.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'istheweb.corporate::lang.labels.maxItems',
                'description'       => 'istheweb.corporate::lang.descriptions.maxItems',
                'default'           => 20,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'slug' => [
                'title'       => 'istheweb.corporate::lang.labels.slug',
                'description' => 'istheweb.corporate::lang.labels.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'projectCategoryPage' => [
                'title'       => 'istheweb.corporate::lang.project_category.label',
                'description' => 'istheweb.corporate::lang.project_category.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/category',
            ],
            'orderBy'  => [
                'title'       => 'istheweb.corporate::lang.labels.orderBy',
                'description' => 'istheweb.corporate::lang.descriptions.orderBy',
                'type'        => 'dropdown',
                'default'     => 'id',
            ],
            'sort'     => [
                'title'       => 'istheweb.corporate::lang.labels.sort',
                'description' => 'istheweb.corporate::lang.descriptions.sort',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
        ];
    }

    public function onRun()
    {
        $this->project = $this->page['project'] = $this->loadProject();
        $this->relatedProjects = $this->page['relatedProjects'] = $this->loadRelated();

        $this->page['share_url'] = Request::url();
    }

    protected function loadProject()
    {
        $slug = $this->property('slug');
        $project = ProjectModel::where('slug', $slug)->first();

        if ($project && $project->project_categories->count()) {
            $project->project_categories->each(function($category){
                $category->setUrl($this->categoryPage, $this->controller);
            });
        }

        return $project;
    }

    protected function loadRelated(){
        if($this->project && $this->project->project_categories->count()) {

            foreach($this->project->project_categories as $category){
                $cat_ids[] = $category->id;
            }

            $related = ProjectModel::with('picture')
                ->whereHas('project_categories',
                    function($query) use ($cat_ids){
                        $query->whereIn('id', $cat_ids);
                    })
                ->where('id', '<>', $this->project->id)
                ->take(3)
                ->get();
            return $related;
        }

    }

    public function getProjectCategoryPageOptions(){
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_coorporation_projects');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('istheweb.corporate::lang.labels.descending'),
            'asc'  => Lang::get('istheweb.corporate::lang.labels.ascending'),
        ];
    }

}