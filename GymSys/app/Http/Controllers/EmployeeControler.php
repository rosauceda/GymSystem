<?php

namespace GymSys\Http\Controllers;

use Illuminate\Http\Request;

// Allows use DataBases
use DB;

use Illuminate\Support\Facades\Auth;


class EmployeeControler extends Controller
{
    //

    public function LoginView($value='')
    {
      return view("Login");
    }
    // End function

    public function LoginEmployee()
    {

      // Region Variables
      $EmpName=" ";

      // Get Employee Number From ajax call
      $EmpNumbr=$_POST['EMPNMBR'];

      // Get Employee Pass from ajax call
      $EmpPass=$_POST['PASS'];

      // echo $EmpNumbr. " :: ".$EmpPass;

      { /* Region Get Employee by EmpNumber */

        // Buil the query
        $Employees = DB::table('employees')
        ->select('Name', 'FstName', 'LstName', 'EmpRoles_Id')
        ->where('Id', '=', $EmpNumbr )
        ->where('password', '=',$EmpPass)
        ->get();

        // Iterate over DataBase Table. Create an object from Employees dataBase table
        foreach ($Employees as $_Employee) {

          $EmpName=$_Employee->Name;

          // Display Table info. Acces to the Fields database table
          // echo $EmpName. " :: ". $_Employee->FstName." :: ". $_Employee->LstName." :: ".$_Employee->EmpRoles_Id;

        }
        // End Foreach

        if ($EmpName==" ") {

          session()->flush();

        }else {

            // Specifying a default value...
            $value = session('key', 'default');

            // Store a piece of data in the session...
            session(['key' => $EmpName]);

            // Validate session variable
            if (session()->has('key')) {

              // redirect user to the view
              echo "1";
            }

        }



      } /* End Region */

    }
    // End function



    public function GetEmployees()
    {

      // Buil the query
      $Employees = DB::table('Employees')->get();

      // Iterate over DataBase Table. Create an object from Employees dataBase table
      foreach ($Employees as $_Employee) {

        // Display Table info. Acces to the Fields database table
        echo $_Employee->Name. " :: ". $_Employee->FstName." :: ". $_Employee->LstName. " :: ".$_Employee->Address." :: ".$_Employee->Phone;

      }
      // End Foreach

    }
    // End function


}
// End Class
