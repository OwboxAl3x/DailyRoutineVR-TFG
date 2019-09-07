using System;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Valve.VR;

public class colliderMochila : MonoBehaviour
{
    public SteamVR_Action_Boolean grabAction;
    public SteamVR_Input_Sources handType;
    
    private GameObject collidingObject;
    
    private NetworkManager m_networkManager = null;

    public AudioClip correcto;
    public AudioClip incorrecto;
    
    public AudioSource source
    {
        get { return GetComponent<AudioSource>();  }
    }

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
        if (other.name != "LeftHand" && other.name != "RightHand" && other.name != "HeadCollider")
        {
            SetCollidingObject(other);
        }
    }

    private void OnTriggerExit(Collider other)
    {
        if (!collidingObject)
        {
            return;
        }

        collidingObject = null;
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
    
    private void soltandoObject()
    {
        string tipo = esBueno(collidingObject.name) ? "CORRECTO" : "ADICION";

        if (PlayerPrefs.GetString("FeedbackAu") == "True")
        {
            if (tipo == "CORRECTO")
            {
                source.PlayOneShot(correcto);
            }
            else
            {
                source.PlayOneShot(incorrecto);
            }
        }

        if (PlayerPrefs.GetString("FeedBackVi") == "True")
        {
            if (tipo == "CORRECTO")
            {
                for (int i = 0; i < ObjetoManager.objetos.Count; i++)
                {
                    if (ObjetoManager.objetos[i].name == collidingObject.name)
                    {
                        ObjetoManager.objetos.RemoveAt(i);
                    }
                }
            }
        }

        // Insertar detalle de tipo ADICION o CORRECTO
        m_networkManager.registerDetail(PlayerPrefs.GetString("idPrueba"), tipo, "Guarda "+collidingObject.name, delegate(Response response)
        {
            if (response.done == true)
            {
                print(response.message);
            }
        });
    }

    private void Start()
    {
        gameObject.AddComponent<AudioSource>();
    }

    private void Awake()
    {
        m_networkManager = GameObject.FindObjectOfType<NetworkManager>();
    }
    
    void Update()
    {
        if (grabAction.GetLastStateUp(handType) && (collidingObject != null) && (collidingObject.name != "LeftHand") && (collidingObject.name != "RightHand") && (collidingObject.name != "HeadCollider"))
        {
            soltandoObject();
        }
    }
    
}
