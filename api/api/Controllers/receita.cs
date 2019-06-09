using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace api.Controllers
{
    public class Receita
    {
        public int Id { get; set; }
        public int Votos { get; set; }
        public string Nome { get; set; }
        public string Url { get; set; }
        public string DescricaoReceita { get; set; }


    }
}
