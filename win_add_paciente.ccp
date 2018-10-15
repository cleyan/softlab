<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="True" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="pacientes" dataSource="pacientes" errorSummator="Error" wizardCaption="Agregar/Editar Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="frmBuscarPaciente.ccp" PathID="pacientes">
			<Components>
				<TextBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="rut" fieldSource="rut" required="False" caption="R.U.T." wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" unique="True" visible="Yes" PathID="pacientesrut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="ficha" fieldSource="ficha" required="False" caption="Ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientesficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nombres" fieldSource="nombres" caption="Nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="pacientesnombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="apellidos" fieldSource="apellidos" caption="Apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="pacientesapellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="direccion" wizardTheme="Inline" wizardThemeType="File" fieldSource="direccion" visible="Yes" PathID="pacientesdireccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="fono" wizardTheme="Inline" wizardThemeType="File" fieldSource="fono" visible="Yes" PathID="pacientesfono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="celular" wizardTheme="Inline" wizardThemeType="File" fieldSource="celular" visible="Yes" PathID="pacientescelular">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="ciudad" wizardTheme="Inline" wizardThemeType="File" fieldSource="ciudad" visible="Yes" PathID="pacientesciudad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="email" wizardTheme="Inline" wizardThemeType="File" fieldSource="email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$" visible="Yes" PathID="pacientesemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha_nacimiento" fieldSource="fecha_nacimiento" caption="Fecha Nacimiento" wizardCaption="Fecha Nacimiento" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" visible="Yes" PathID="pacientesfecha_nacimiento">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="30"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="edad_calc" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="edad" wizardTheme="Inline" wizardThemeType="File" fieldSource="edad" visible="Yes" PathID="pacientesedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="sexo_id" fieldSource="sexo_id" caption="Sexo" wizardCaption="Sexo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="sexos" boundColumn="sexo_id" textColumn="nom_sexo" required="True" visible="Yes" PathID="pacientessexo_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="12" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_id" fieldSource="prevision_id" caption="Prevision" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_prevision" required="True" visible="Yes" PathID="pacientesprevision_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="'V'" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="pacientesButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="pacientesButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="pacientesButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="6" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="29"/>
					</Actions>
				</Event>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="31"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="paciente_id" parameterSource="paciente_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups>
				<Group id="33" groupID="4" read="True" insert="True" update="True"/>
				<Group id="34" groupID="5" read="True" insert="True" update="True"/>
				<Group id="35" groupID="12" read="True" insert="True" update="True"/>
				<Group id="36" groupID="13" read="True" insert="True" update="True"/>
				<Group id="37" groupID="14" read="True" insert="True" update="True"/>
				<Group id="38" groupID="15" read="True" insert="True" update="True"/>
				<Group id="39" groupID="16" read="True" insert="True" update="True" delete="True"/>
				<Group id="40" groupID="17" read="True" insert="True" update="True" delete="True"/>
				<Group id="41" groupID="18" read="True" insert="True" update="True" delete="True"/>
				<Group id="42" groupID="20" read="True" insert="True" update="True" delete="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<ImageLink id="21" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="InLine" wizardThemeType="File" hrefSource="#" visible="Yes" PathID="ImageLink1">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="win_add_paciente.php" comment="//" codePage="utf-8" forShow="True" url="win_add_paciente.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="win_add_paciente_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="32"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
