using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Valve.VR;

public class ActionsTest : MonoBehaviour
{
    public SteamVR_Input_Sources handType;
    public SteamVR_Action_Boolean teleportAction;
    
    private GameObject collidingObject;
    
    private NetworkManager m_networkManager = null;

    public void GetTeleportDown()
    {
        string tipo = "DESPLAZAMIENTO";
        
        m_networkManager.registerDetail(PlayerPrefs.GetString("idPrueba"), tipo, "Se ha querido/conseguido teleportar " + GlobalObjetos.teleports + " veces sin coger objetos", delegate(Response response)
        {
            if (response.done == true)
            {
                print(response.message);
            }
        });
    }
    
    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }
    
    void Update()
    {
        if (teleportAction.GetStateDown(handType))
        {
            GlobalObjetos.teleports += 1;
            
            if (GlobalObjetos.teleports >= 3)
            {
                m_networkManager.getLastDetail(PlayerPrefs.GetString("idPrueba"), GlobalObjetos.teleports, delegate(Response response)
                {
                    if (response.done == true)
                    {
                        print(response.message);
                    }
                    else
                    {
                        print(response.message);
                        GetTeleportDown();
                    }
                });
            }
        }
    }
}
