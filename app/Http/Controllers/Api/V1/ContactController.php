<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Dedoc\Scramble\Attributes\PathParameter;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Dedoc\Scramble\Attributes\ExcludeRouteFromDocs;
use Dedoc\Scramble\Attributes\Endpoint;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Details on Resources, Resource Collections etc.
     * https://laravel.com/docs/12.x/eloquent-resources
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function index()
    {
        $contacts = Contact::paginate(2)->toResourceCollection();
        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[ExcludeRouteFromDocs]
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        $contact = Contact::create($validated);
        return response()->json($contact, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
//        ds($contact);
//        ds($contact->toResource());
        $result = $contact->toResource();
        return response()->json($result);

    }

    /**
     * Update the specified resource in storage.
     */
    #[PathParameter('contact', description: 'update contact', type: 'integer')]
    #[Endpoint(method: 'PUT')]
    public function update(UpdateContactRequest $request, Contact $contact)
    {


        $validated = $request->validated();
        $contact->update($validated);
        return response()->json($contact, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
