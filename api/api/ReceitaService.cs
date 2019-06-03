using api.Controllers;
using System;
using MySql.Data;


namespace api
{
    public class ReceitaService
    {

        public ReceitaService()
        {

            string command = "select * from receitas";

            Console.WriteLine("Making query: " + command);

            MySqlConnection connection;
            MySqlDataReader reader;
            MySqlCommand cmd;

            connection = new MySqlConnection("datasource=127.0.0.1;port=3306;username=root;password=;database=tecweb;");

            cmd = connection.CreateCommand();
            cmd.CommandText = command;
            DataTable dataTable = new DataTable();


            try
            {
                connection.Open();
                cmd.CommandTimeout = int.MaxValue;
                reader = cmd.ExecuteReader();

                //Preencher Tabela

                dataTable.Load(reader);

                reader.Close();
                connection.Close();
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
            }

            Console.WriteLine("Query Ended");



            //connection = new SqlConnection("datasource=127.0.0.1;port=3306;username=root;password=;database=test;");
            //connection.Open();
        }

        public void Adicionar(Receita receita)
        {
            connection.Open();
            SqlCommand comando = new SqlCommand("insert into", connection); //não é só isso

            comando.ExecuteNonQuery();
            connection.Close();
        }

        public Receita Buscar(int id)
        {
            connection.Open();

            SqlCommand comando = new SqlCommand("select", connection); //não é só isso
            SqlDataReader reader = comando.ExecuteReader();

            reader.Read();

            Receita rec = new Receita();
            rec.Id = reader.GetInt32(0);
            rec.Votos = reader.GetInt32(1);
            rec.Nome = reader.GetString(2);
            rec.Url = reader.GetString(3);
            rec.DescricaoReceita = reader.GetString(4);

            connection.Close();
            return rec;
        }



        public List<Receita> Buscar()
        {
            connection.Open();

            SqlCommand comando = new SqlCommand("select", connection); //não é só isso
            SqlDataReader reader = comando.ExecuteReader();

            List<Receita> listaReceitas = new List<Receita>();

            while (reader.Read())
            {
                Receita rec = new Receita();
                rec.Id = reader.GetInt32(0);
                rec.Votos = reader.GetInt32(1);
                rec.Nome = reader.GetString(2);
                rec.Url = reader.GetString(3);
                rec.DescricaoReceita = reader.GetString(4);

                listaReceitas.Add(rec);
            }
            connection.Close();

            return listaReceitas;

        }

        public void Atualizar(Receita receita)
        {

            connection.Open();
            SqlCommand comando = new SqlCommand("update into", connection); //não é só isso

            comando.ExecuteNonQuery();
            connection.Close();
        }

    }
}
