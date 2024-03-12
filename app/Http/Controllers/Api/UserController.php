        <?php

        namespace App\Http\Controllers\Api;

        use App\Http\Controllers\Controller;
        use App\Models\Utilisateurs;
        use Illuminate\Http\Request;
        use App\Http\Requests\RegisterUser;
        use App\Models\User;
        // Remove the conflicting import statement
        // use App\Models\Utilisateurs;
        use Illuminate\Support\Facades\Hash;
        use Illuminate\Support\Facades\Log;
        use App\Http\Requests\LogUserRequest;
        use App\Http\Requests\DeleteUserRequest;    
        use App\Http\Requests\CreatePostRequest;
        use Exception;
        class UserController extends Controller
        {
            public function register(RegisterUser $request)
            {
                try{
                $user=new Utilisateurs();
                $user->nom=$request->nom;
                $user->prenom=$request->prenom;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->type = 1; // 1 for normal user, 2 for admin
                $user->save();
                    return response()->json([
                    'status_code' => 200,
                    'status_message'=>'Utilisateur enregistré',
                    'user'=>$user
                    ]);
                }
                catch(\Exception $e){
                    return response()->json($e);
                }
                
            }

            public function user(Request $request){
                return response()->json($request->user());
            }
            public function login(LogUserRequest $request){
        if(auth()->attempt($request->only('email','password'))){
            $user=auth()->user();
            $token=$user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'status_message'=>'Utilisateur connecté',
                'utilisateurs'=>$user,
                'token'=>$token
            ]);}
            else{
                //si les les informations de connexion sont incorrectes
                return response()->json([
                'status_code' => 403 ,
                'status_message'=>'Informations de connexion incorrectes',
                ]);
            } 
            }
            public function logout(Request $request){
                try{
                    if ($request->utilisateurs()) {
                        // Révoquez le token
                        $request->utilisateurs()->currentAccessToken()->delete();
                    }
                    return response()->json([
                        'status_code' => 200,
                        'status_message'=>'Utilisateur déconnecté',
                    ]);
                }
                catch(Exception $e){
                    return response()->json($e);
                }
                
            }

            public function destroy(Request $request)
            {
                try {
                    $user = User::findOrFail($request->id);
                    if($user->id != auth()->utilisateurs()->id){
                        return response()->json([
                            'status_code' => 403,
                            'status_message'=>'Vous n\'êtes pas autorisé à supprimer cet utilisateur',
                        ]);}
                    $user->delete();
            
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'L\'utilisateur a été supprimé',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status_code' => 500,
                        'status_message' => 'Une erreur est survenue lors de la suppression de l\'utilisateur : ' . $e->getMessage(),
                    ]);
                }
            }


        public function update(Request $request, Utilisateurs $user)
        {
            try {
                if($user->id != auth()->utilisateur()->id){
                    return response()->json([
                        'status_code' => 403,
                        'status_message'=>'Vous n\'êtes pas autorisé à modifier cet utilisateur',
                    ]);
                }

                $user->nom = $request->get('nom', $user->nom);
                $user->prenom = $request->get('prenom', $user->prenom);
                $user->email = $request->get('email', $user->email);
                // Add more fields here as needed

                $user->save();

                return response()->json([
                    'status_code' => 200,
                    'status_message'=>'L\'utilisateur a été modifié',
                    'data'=>$user
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status_code' => 500,
                    'status_message' => 'Une erreur est survenue lors de la modification de l\'utilisateur : ' . $e->getMessage(),
                ]);
            }
        }
        }
                // handle exception




