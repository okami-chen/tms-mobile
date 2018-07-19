<?php

namespace OkamiChen\TmsMobile\Console\Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use PhpOffice\PhpSpreadsheet\IOFactory;
use OkamiChen\TmsMobile\Entity\Mobile;

class ImportCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tms:mobile:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入手机文件';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->__argument();
    }

    /**
     * 
     */
    protected function __argument() {
        $file = new InputArgument('file', InputArgument::REQUIRED, '必须填写');
        $this->getDefinition()->addArgument($file);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $file = $this->argument('file');
        $filter = ['../', './', '/'];
        $place = ['', '', ''];
        $file = str_replace($filter, $place, $file);
        $path = base_path('data/xls/') . $file;

        if (!file_exists($path)) {
            $this->error($path . ' Not Found.');
            return false;
        }

        if (!is_readable($path)) {
            $this->error($path . ' No Readable.');
            return false;
        }

        $PHPExcel = IOFactory::load($path);
        $sheet = $PHPExcel->getSheet(0);
        $row = $sheet->getHighestRow();
        
        if (!$row) {
            $this->error('未读取到excel内容');
            return false;
        }
        $headers    = [
            '姓名','手机号','服务商','标志','备注'
        ];
        $index  = [
            'name','mobile','provider','flag','remark'
        ];
        $this->table($headers, $sheet->toArray());
        if($this->ask('确认清空已有记录并导入?', '确认:y,取消:n') == 'n'){
            return false;
        }
        
        $rows   = array_map(function($row) use($index){
            $row = array_combine($index, $row);
            $row['mobile']  = str_replace(' ', '', $row['mobile']);
//            $row['created_at']  = date('Y-m-d H:i:s');
//            $row['updated_at']  = date('Y-m-d H:i:s');
            return $row;
        }, $sheet->toArray());

        foreach ($rows as $key => $row) {
            $mobile = (new Mobile())->forceFill($row);
            $mobile->save();
            $this->line($row['mobile'] .' import successed.');
        }
    }

}
