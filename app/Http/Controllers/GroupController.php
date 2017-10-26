<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;
use Auth;

use GoodlerJudge\Http\Requests\GroupRequest;
use GoodlerJudge\Problem;
use GoodlerJudge\User;
use GoodlerJudge\Group;
use Illuminate\Http\Request;

class GroupController extends Controller {

	/**
	 * Create a new group controller instance.
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index']]);
		$this->middleware('group_owner', ['only' => ['edit',
		                                             'destroy',
		                                             'update']]);
		$this->middleware('group_member', ['only' => ['show']]);
	}
	/**
	 * Show Goodler Judge group list.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = Group::latest('created_at')->get();

		return view('groups.index', compact('groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = User::lists('email', 'id');
		$problems = Problem::lists('name', 'id');
		return view('groups.create', compact('users', 'problems'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param GroupRequest $request
	 * @return Response
	 */
	public function store(GroupRequest $request)
	{
		$this->createGroup($request);
		return redirect('group');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Group $group
	 * @return Response
	 */
	public function show(Group $group)
	{
		return view('groups.show', compact('group'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Group $group
	 * @return Response
	 */
	public function edit(Group $group)
	{
		$users = User::lists('email', 'id');
		$problems = Problem::lists('name', 'id');
		return view('groups.edit', compact('group', 'users', 'problems'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Group $group
	 * @param GroupRequest $request
	 * @return Response
	 */
	public function update(Group $group, GroupRequest $request)
	{
		$group->update($request->except('user_list'));
		$this->syncUsers($group, array_merge($request->input('user_list'),
		                                    [$group->user_id]));
		$this->syncProblems($group, $request->input('problem_list'));
		return view('groups.show', compact('group'));

	}

	/**
	 * Remove the group from database.
	 *
	 * @param Group $group
	 * @return Response
	 */
	public function destroy(Group $group)
	{
		Group::destroy($group->id);
		return redirect('group');
	}

	/**
	 * Sync up the lists of users in the database.
	 *
	 * @param Group $group
	 * @param array $users
	 */
	private function syncUsers(Group $group, array $users)
	{
		$group->users()->sync($users);
	}

	/**
	 * Sync up the lists of problems in the database.
	 *
	 * @param Group $group
	 * @param array $problems
	 */
	private function syncProblems(Group $group, array $problems)
	{
		$group->problems()->sync($problems);
	}

	/**
	 * Create a new group.
	 *
	 * @param GroupRequest $request
	 * @return Group
	 */
	private function createGroup(GroupRequest $request)
	{
		$group = new Group($request->except('user_list'));
		$group->user()->associate(Auth::user())->save();
		$this->syncUsers($group, array_merge($request->input('user_list'),
		                                     [$group->user_id]));
		$this->syncProblems($group, $request->input('problem_list'));

		return $group;
	}

}
