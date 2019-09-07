using System;
using System.Globalization;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public static class GlobalObjetos
{
    public static List<Objeto> objetosGlobal;
    public static int teleports = 0;
    public static float timeLeft;

    static GlobalObjetos()
    {
        objetosGlobal = new List<Objeto>();
    }
}

public class Persistencia : MonoBehaviour
{
    private string objetos = "";
    private bool saliendo = false;
    
    private NetworkManager m_networkManager = null;
    
    // Start is called before the first frame update
    void Start()
    {
        float segundos = (float)Int32.Parse(PlayerPrefs.GetString("Minutos")) * 60;
        GlobalObjetos.timeLeft = segundos;
    }
    
    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }

    private void Update()
    {
        GlobalObjetos.timeLeft -= Time.deltaTime;

        if ((GlobalObjetos.timeLeft <= 0.0f || Input.GetKey("escape")) && !saliendo)
        {
            saliendo = true;
            
            foreach (var obj in GlobalObjetos.objetosGlobal)
            {
                objetos += obj.name + ", ";
            }

            objetos = objetos.Remove(objetos.Length - 2);
            
            m_networkManager.finalizar(objetos, PlayerPrefs.GetString("idPrueba"), delegate(Response response)
            {
                if (response.done == true)
                {
                    UnityEngine.SceneManagement.SceneManager.LoadScene("Finalización");
                }
            });
        }
    }
}
