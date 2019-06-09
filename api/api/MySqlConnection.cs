using System;

namespace api
{
    internal class MySqlConnection
    {
        private string v;

        public MySqlConnection(string v)
        {
            this.v = v;
        }

        internal MySqlCommand CreateCommand()
        {
            throw new NotImplementedException();
        }
    }
}