using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public enum ObjetoType { Bueno, Malo }

[System.Serializable]
public class Objeto
{
    public string id;
    public string name;
    public string type;
}