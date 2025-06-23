<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function about(): View
    {
        return view('about');
    }

    public function projects(): View
    {
        $projects = Project::latest()->get();
        return view('projects', compact('projects'));
    }

    public function showProject(Project $project): View
    {
        return view('project-show', compact('project'));
    }

    public function contact(): View
    {
        return view('contact');
    }
}
