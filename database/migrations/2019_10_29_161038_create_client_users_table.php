    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateClientUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('client_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email')->unique();
                $table->string('phone')->unique();
                $table->string('status')->default(0);
                $table->string('gender');
                $table->string('relationShip');
                $table->string('live');
                $table->string('image')->nullable();
                $table->string('birthday');
                $table->string('pet');
                $table->string('flock');
                $table->string('kickMyDay');
                $table->string('phoneUsage');
                $table->string('myFridge');
                $table->string('afterLongDay');
                $table->string('food');
                $table->string('goingOut');
                $table->string('life');
                $table->text('aboutMe')->nullable();
                $table->text('hobby')->nullable();

                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('client_users');
        }
    }
