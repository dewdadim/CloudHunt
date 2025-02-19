<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Softonic\GraphQL\ClientBuilder;

class CourseController extends Controller
{
    public function index() {
        // try {
        //     $blog = app('Course')->query('home-course');
        // } catch (\Exception $e) {
        //     abort(503, "CloudHunt Course is temporarily unavailable.");
        // }

        // // if no data, errors from WPGraphQL side, return 503
        // if($blog->hasError()) {
        //     abort(503, "CloudHunt Courseis temporarily unavailable.");
        // }

        // // if empty/notfound or posts is empty
        // // return 503 on main page because blog should be not empty
        // if ($blog->isEmpty() || $blog->isResourceEmpty('latest.nodes')) {
        //     abort(503, "CloudHunt Course is temporarily unavailable.");
        // }

        $client = ClientBuilder::build(env('CLOUDHUNT_CMS_GRAPHQL_URL'));
        $response = $client->query('query GET_COURSE_HOME {
            courses {
                nodes {
                id
                databaseId
                title
                slug
                uri
                date
                modified
                
                featuredImage {
                    node {
                    mediaItemUrl
                    }
                }
                }
            }
        }');
        // Extracting course data
        $courses = $response->getData()['courses']['nodes'] ?? [];

        // Transforming data to the desired structure
        $formattedCourses = array_map(function($course) {
            return [
                'id' => $course['id'],
                'databaseId' => $course['databaseId'],
                'title' => $course['title'],
                'slug' => $course['slug'],
                'uri' => $course['uri'],
                'date' => $course['date'],
                'modified' => $course['modified'],
                'featuredImage' => $course['featuredImage']['node']['mediaItemUrl'] ?? null,
            ];
        }, $courses);

        // dd($formattedCourses);

        return Inertia::render('Courses/Index', [
            'courses' => $formattedCourses
        ]);
    }
}
