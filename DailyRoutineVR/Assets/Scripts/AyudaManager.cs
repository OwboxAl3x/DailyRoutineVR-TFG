using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Valve.VR;

public class AyudaManager : MonoBehaviour
{
    public SteamVR_Input_Sources handType;
    public SteamVR_Action_Boolean ayudaAction;
    public GameObject ayuda;
    
    private NetworkManager m_networkManager = null;
    
    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }

    private void Update()
    {
        if (ayudaAction.GetStateDown(handType) && (PlayerPrefs.GetString("FeedBackVi") == "True") )
        {
            if (!ayuda.activeSelf)
            {
                m_networkManager.registerDetail(PlayerPrefs.GetString("idPrueba"), "PREGUNTA", "Ha consultado la ayuda", delegate(Response response)
                {
                    if (response.done == true)
                    {
                        ayuda.SetActive(!ayuda.activeSelf);
                    }
                });
            }
            else
            {
                ayuda.SetActive(!ayuda.activeSelf);
            }
        }
    }
}