<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImapConfigurationUpdateRequest;
use App\Http\Requests\OpenAIConfigurationUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        return view('settings.index', [
            'user' => $request->user()
        ]);
    }

    public function updateImapConfiguration(ImapConfigurationUpdateRequest $request): RedirectResponse
    {
        $imapConfiguration = $request->validated()['imap_configuration'];

        $request->user()->imapConfiguration()->update($imapConfiguration);

        return to_route('settings.index')->with('status', 'imap-configuration-updated');
    }

    public function updateOpenAIConfiguration(OpenAIConfigurationUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated())->save();

        return to_route('settings.index')->with('status', 'open-ai-configuration-updated');
    }
}
