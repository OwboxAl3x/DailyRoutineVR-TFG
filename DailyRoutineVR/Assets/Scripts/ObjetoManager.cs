using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Valve.VR;

public class ObjetoManager : MonoBehaviour 
{
    public static List<Objeto> objetos;
    private NetworkManager m_networkManager = null;
    
    public SteamVR_Input_Sources handType;
    public SteamVR_Action_Boolean listAction;
    public GameObject lista;

    private String[] listaObjetos;

    private void Start()
    {
        objetos = new List<Objeto>();
        listObjects();
    }

    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }
    
    void Update()
    {
        if (GetList())
        {
            lista.SetActive(!lista.activeSelf);
        }
        
    }
    
    public bool GetList()
    {
        return listAction.GetStateDown(handType);
    }

    public void listObjects()
    {
        m_networkManager.listObjects(PlayerPrefs.GetString("Actividad"), delegate(Response response)
        {
            if (response.done == true)
            {
                listaObjetos = response.message.Split(';');
                for (int i = 0; i < listaObjetos.Length; i++)
                {
                    if (listaObjetos[i].Split(',')[2] == "1") // Compruebo si es bueno para mostrarlo en la lista
                    {
                        objetos.Add(new Objeto()
                        {
                            id = listaObjetos[i].Split(',')[0],
                            name = listaObjetos[i].Split(',')[1],
                            type = listaObjetos[i].Split(',')[2]
                        });
                    }
                }

                foreach (var obj in objetos)
                {
                    GlobalObjetos.objetosGlobal.Add(obj);
                }
            }
        });
    }

}