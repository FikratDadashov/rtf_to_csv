<?php

namespace App\Http\Controllers;

use App\Models\File;

use Illuminate\Http\Request;
use RtfHtmlPhp\Document;
use RtfHtmlPhp\Html\HtmlFormatter;
use App\Exports\RtfToCsvExport;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{


    public function index()
    {
        $data['files'] = File::all();
        return view('index')->with($data);
    }

    public function store(Request $request)
    {
        $file = new File();
        $file->name = $request->file('rtf_file')->getClientOriginalName();
        $file->hashname = $request->file('rtf_file')->HashName();
        $extension = $request->file('rtf_file')->extension();
        if ($extension == "rtf") {
            $request->file('rtf_file')->store('/uploads');
            $file->save();
            return redirect("/")->with('success', 'File added successfully');
        } else {
            return redirect("/")->with('error', 'Please upload rtf file');
        }
    }

    public function download($id)
    {
        $file = File::find($id);

        $rtf = file_get_contents(url('../storage/app/uploads/') . '/' . $file->hashname);
        $data = array();

        $document = new Document($rtf);
        $formatter = new HtmlFormatter();
        $formatter->Format($document);
        $text = '';
        $j = 0;
        $header = $formatter->header;
        $body = $formatter->body;
        for ($i = 0; $i < count($header); $i++) {
            if ($i == count($header) - 1) {
                while ($j < count($body)) {
                    $text .= $body[$j];
                    if ($j < count($body)) {
                        $j++;
                    }
                }
            } else {
                while ($header[$i + 1] != $body[$j]) {
                    $text .= $body[$j];
                    if ($j < count($body)) {
                        $j++;
                    }
                }
            }

            array_push($data, explode("&nbsp;", $text));
            $text = '';
        }

        return Excel::download(new  RtfToCsvExport($data), 'rtf_file.csv');

    }

    public function destroy($id)
    {
        File::destroy($id);
        return redirect("/")->with('success', 'File deleted successfully');
    }

}
