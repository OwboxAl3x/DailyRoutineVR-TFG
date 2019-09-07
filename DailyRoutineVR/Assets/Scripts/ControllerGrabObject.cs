using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

using Valve.VR;

public class ControllerGrabObject : MonoBehaviour
{
    public SteamVR_Input_Sources handType;
    public SteamVR_Behaviour_Pose controllerPose;
    public SteamVR_Action_Boolean grabAction;

    private GameObject collidingObject;
    private GameObject objectInHand;

    private NetworkManager m_networkManager = null;
    
    private void SetCollidingObject(Collider col)
    {
        if (collidingObject || !col.GetComponent<Rigidbody>())
        {
            return;
        }

        collidingObject = col.gameObject;
    }

    public void OnTriggerEnter(Collider other)
    {
        SetCollidingObject(other);
    }

    public void OnTriggerStay(Collider other)
    {
        SetCollidingObject(other);
    }

    private void OnTriggerExit(Collider other)
    {
        if (!collidingObject)
        {
            return;
        }

        collidingObject = null;
    }
    
    public void GetGrab()
    {
        m_networkManager.registerDetail(PlayerPrefs.GetString("idPrueba"), "ADHESION", "Coje "+collidingObject.name, delegate(Response response)
        {
            if (response.done == true)
            {
                print(response.message);
            }
        });
    }
    
    private bool esBueno(string nombre)
    {
        foreach (var objeto in GlobalObjetos.objetosGlobal)
        {
            if ((objeto.name == nombre) && (objeto.type == "1"))
            {
                return true;
            }
        }

        return false;
    }
    
    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }

    // Update is called once per frame
    void Update()
    {
        if (grabAction.GetStateDown(handType))
        {
            if (collidingObject)
            {
                GlobalObjetos.teleports = 0;
                
                if (!esBueno(collidingObject.name) && (collidingObject.name != "mochila_abierta"))
                {
                    GetGrab();
                }
            }
        }
    }
}
