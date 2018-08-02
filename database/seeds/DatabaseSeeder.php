<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('seasons')->insert([
            'season' => '1819',
            'first_saturday' => '2018-08-11 00:00:00',
            'last_sunday' => '2019-05-12 00:00:00',
            'current' => 1,
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'rob',
            'email' => 'robbiechicago@gmail.com',
            'password' => bcrypt('rohoco'),
            'paid' => 1,
            'active' => 1, 
            'is_admin' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 1, 'play_week_num' => 1, 'week_saturday' => '2018-08-11', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 2, 'play_week_num' => 2, 'week_saturday' => '2018-08-18', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 3, 'play_week_num' => 3, 'week_saturday' => '2018-08-25', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 4, 'play_week_num' => 4, 'week_saturday' => '2018-09-01', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 5, 'play_week_num' => 5, 'week_saturday' => '2018-09-08', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 6, 'play_week_num' => 6, 'week_saturday' => '2018-09-15', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 7, 'play_week_num' => 7, 'week_saturday' => '2018-09-22', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 8, 'play_week_num' => 8, 'week_saturday' => '2018-09-29', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 9, 'play_week_num' => 9, 'week_saturday' => '2018-10-06', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 10, 'play_week_num' => 10, 'week_saturday' => '2018-10-13', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 11, 'play_week_num' => 11, 'week_saturday' => '2018-10-20', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 12, 'play_week_num' => 12, 'week_saturday' => '2018-10-27', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 13, 'play_week_num' => 13, 'week_saturday' => '2018-11-03', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 14, 'play_week_num' => 14, 'week_saturday' => '2018-11-10', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 15, 'play_week_num' => 15, 'week_saturday' => '2018-11-17', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 16, 'play_week_num' => 16, 'week_saturday' => '2018-11-24', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 17, 'play_week_num' => 17, 'week_saturday' => '2018-12-01', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 18, 'play_week_num' => 18, 'week_saturday' => '2018-12-08', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 19, 'play_week_num' => 19, 'week_saturday' => '2018-12-15', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 20, 'play_week_num' => NULL, 'week_saturday' => '2018-12-22', 'is_winterval' => 1, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 21, 'play_week_num' => NULL, 'week_saturday' => '2018-12-29', 'is_winterval' => 1, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 22, 'play_week_num' => 20, 'week_saturday' => '2019-01-05', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 23, 'play_week_num' => 21, 'week_saturday' => '2019-01-12', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 24, 'play_week_num' => 22, 'week_saturday' => '2019-01-19', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 25, 'play_week_num' => 23, 'week_saturday' => '2019-01-26', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 26, 'play_week_num' => 24, 'week_saturday' => '2019-02-02', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 27, 'play_week_num' => 25, 'week_saturday' => '2019-02-09', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 28, 'play_week_num' => 26, 'week_saturday' => '2019-02-16', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 29, 'play_week_num' => 27, 'week_saturday' => '2019-02-23', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 30, 'play_week_num' => 28, 'week_saturday' => '2019-03-02', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 31, 'play_week_num' => 29, 'week_saturday' => '2019-03-09', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 32, 'play_week_num' => 30, 'week_saturday' => '2019-03-16', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 33, 'play_week_num' => 31, 'week_saturday' => '2019-03-23', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 34, 'play_week_num' => 32, 'week_saturday' => '2019-03-30', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 35, 'play_week_num' => 33, 'week_saturday' => '2019-04-06', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 36, 'play_week_num' => 34, 'week_saturday' => '2019-04-13', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 37, 'play_week_num' => 35, 'week_saturday' => '2019-04-20', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 38, 'play_week_num' => 36, 'week_saturday' => '2019-04-27', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 39, 'play_week_num' => 37, 'week_saturday' => '2019-05-04', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('weeks')->insert(['season_id' => 1, 'week_num' => 40, 'play_week_num' => 38, 'week_saturday' => '2019-05-11', 'is_winterval' => 0, 'active' => 1, 'created_at' => date('Y-m-d H:i:s')]);


        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 1, 'home_team' => 'Newcastle', 'away_team' => 'Tottenham', 'kickoff_datetime' => '2018-08-11 12:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 2, 'home_team' => 'Bournemouth', 'away_team' => 'Cardiff', 'kickoff_datetime' => '2018-08-11 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 3, 'home_team' => 'Fulham', 'away_team' => 'Crystal Palace', 'kickoff_datetime' => '2018-08-11 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 4, 'home_team' => 'Huddersfield', 'away_team' => 'Chelsea', 'kickoff_datetime' => '2018-08-11 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 5, 'home_team' => 'Watford', 'away_team' => 'Brighton', 'kickoff_datetime' => '2018-08-11 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 6, 'home_team' => 'Stoke', 'away_team' => 'Brentford', 'kickoff_datetime' => '2018-08-11 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 7, 'home_team' => 'Wolves', 'away_team' => 'Everton', 'kickoff_datetime' => '2018-08-11 17:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 8, 'home_team' => 'Liverpool', 'away_team' => 'West Ham', 'kickoff_datetime' => '2018-08-12 13:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 9, 'home_team' => 'Southampton', 'away_team' => 'Burnley', 'kickoff_datetime' => '2018-08-12 13:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 1, 'game_num' => 10, 'home_team' => 'Arsenal', 'away_team' => 'Man City', 'kickoff_datetime' => '2018-08-12 16:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 1, 'home_team' => 'Cardiff', 'away_team' => 'Newcastle', 'kickoff_datetime' => '2018-08-18 12:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 2, 'home_team' => 'Burnley', 'away_team' => 'Watford', 'kickoff_datetime' => '2018-08-18 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 3, 'home_team' => 'Everton', 'away_team' => 'Southampton', 'kickoff_datetime' => '2018-08-18 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 4, 'home_team' => 'Leicester', 'away_team' => 'Wolves', 'kickoff_datetime' => '2018-08-18 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 5, 'home_team' => 'Tottenham', 'away_team' => 'Fulham', 'kickoff_datetime' => '2018-08-18 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 6, 'home_team' => 'West Ham', 'away_team' => 'Bournemouth', 'kickoff_datetime' => '2018-08-18 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 7, 'home_team' => 'Hull', 'away_team' => 'Blackburn', 'kickoff_datetime' => '2018-08-18 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 8, 'home_team' => 'Chelsea', 'away_team' => 'Arsenal', 'kickoff_datetime' => '2018-08-18 17:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 9, 'home_team' => 'Man City', 'away_team' => 'Huddersfield', 'kickoff_datetime' => '2018-08-19 13:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 2, 'game_num' => 10, 'home_team' => 'Brighton', 'away_team' => 'Man Utd', 'kickoff_datetime' => '2018-08-19 16:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 1, 'home_team' => 'Wolves', 'away_team' => 'Man City', 'kickoff_datetime' => '2018-08-25 12:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 2, 'home_team' => 'Arsenal', 'away_team' => 'West Ham', 'kickoff_datetime' => '2018-08-25 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 3, 'home_team' => 'Bournemouth', 'away_team' => 'Everton', 'kickoff_datetime' => '2018-08-25 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 4, 'home_team' => 'Fulham', 'away_team' => 'Burnley', 'kickoff_datetime' => '2018-08-25 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 5, 'home_team' => 'Huddersfield', 'away_team' => 'Cardiff', 'kickoff_datetime' => '2018-08-25 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 6, 'home_team' => 'Southampton', 'away_team' => 'Leicester', 'kickoff_datetime' => '2018-08-25 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 7, 'home_team' => 'Derby', 'away_team' => 'Preston', 'kickoff_datetime' => '2018-08-25 15:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 8, 'home_team' => 'Liverpool', 'away_team' => 'Brighton', 'kickoff_datetime' => '2018-08-25 17:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 9, 'home_team' => 'Watford', 'away_team' => 'Crystal Palace', 'kickoff_datetime' => '2018-08-26 13:30:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('games')->insert(['season_id' => 1, 'week_id' => 3, 'game_num' => 10, 'home_team' => 'Newcastle', 'away_team' => 'Chelsea', 'kickoff_datetime' => '2018-08-26 16:00:00', 'active' => 1, 'created_by' => 1, 'created_at' => date('Y-m-d H:i:s')]);
    }
}
